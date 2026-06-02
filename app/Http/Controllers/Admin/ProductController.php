<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->count();
        $totalValue = Product::sum('price');
        $totalCategories = Category::count();

        return view('admin.products.index', [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'lowStockProducts' => $lowStockProducts,
            'totalValue' => $totalValue,
            'totalCategories' => $totalCategories,
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $request->file('image')->store('products', 'public');
        unset($data['image']);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit ajoute avec succes.');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', ['product' => $product->load('category')]);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteLocalImage($product);
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit modifie avec succes.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteLocalImage($product);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprime avec succes.');
    }

    private function deleteLocalImage(Product $product): void
    {
        if ($product->image_path && ! str_starts_with($product->image_path, 'http')) {
            Storage::disk('public')->delete($product->image_path);
        }
    }
}
