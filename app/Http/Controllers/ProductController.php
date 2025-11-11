<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show all products (product management main page) with optional filtering
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('categorie', $request->category);
        }

        if ($request->filled('stock_status')) {
            $status = $request->stock_status;

            if ($status === 'in_stock') {
                $query->where('voorraad', '>', 5);

            } elseif ($status === 'almost_empty') {
                $query->whereBetween('voorraad', [1, 5]);

            } elseif ($status === 'empty') {
                $query->where('voorraad', 0);
            }
        }

        $products = $query->get();

        $categories = Product::getCategories();
        $stockStatuses = [
            'in_stock' => __('In Stock'),
            'almost_empty' => __('Almost Out of Stock'),
            'empty' => __('Out of Stock'),
        ];

        return view('ProductManegement.main', compact('products', 'categories', 'stockStatuses'));
    }

    /**
     * Show create product form
     */
    public function create()
    {
        $categories = Product::getCategories();
        return view('ProductManegement.create', compact('categories'));
    }

    /**
     * Store a new product in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'categorie' => 'required|string|in:' . implode(',', Product::getCategories()),
            'product_code' => 'required|string|unique:products,product_code|max:255',
            'prijs' => 'required|numeric|min:0',
            'voorraad' => 'required|integer|min:0',
            'installatiekosten' => 'nullable|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('product.management')
            ->with('success', 'Product successfully created!');
    }

    /**
     * Show edit form for a product
     */
    public function edit(Product $product)
    {
        $categories = Product::getCategories();
        return view('ProductManegement.edit', compact('product', 'categories'));
    }

    /**
     * Update a product
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'categorie' => 'required|string|in:' . implode(',', Product::getCategories()),
            'product_code' => 'required|string|unique:products,product_code,' . $product->id . '|max:255',
            'prijs' => 'required|numeric|min:0',
            'voorraad' => 'required|integer|min:0',
            'installatiekosten' => 'nullable|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('product.management')
            ->with('success', 'Product successfully updated!');
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.management')
            ->with('success', 'Product successfully deleted!');
    }
}
