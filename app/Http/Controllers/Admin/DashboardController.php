<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'productsCount' => Product::count(),
            'categoriesCount' => Category::count(),
            'latestProducts' => Product::with('category')->latest()->take(5)->get(),
            'lowStockCount' => Product::where('stock_quantity', '<', 10)->count(),
        ]);
    }
}
