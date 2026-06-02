<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->with(['products' => function ($query) {
                $query->select('category_id', 'price');
            }])
            ->latest()
            ->get();

        // Calculate total value per category
        $categoriesWithValue = $categories->map(function ($category) {
            $category->total_value = $category->products->sum('price');
            return $category;
        });

        return view('admin.categories.index', [
            'categories' => $categoriesWithValue,
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', ['category' => new Category()]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Categorie ajoutee avec succes.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Categorie modifiee avec succes.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->withErrors(['category' => 'Impossible de supprimer une categorie qui contient des produits.']);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categorie supprimee avec succes.');
    }
}
