<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Zobrazí seznam všech produktů
     */
    public function index(): View
    {
        $products = Product::query()
            ->with('category')
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Zobrazí detail produktu
     */
    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Zobrazí produkty podle kategorie
     */
    public function category(Category $category): View
    {
        $products = Product::query()
            ->where('category_id', $category->id)
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }
} 