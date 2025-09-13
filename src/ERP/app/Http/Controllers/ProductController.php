<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('supplier');

        // 🔍 Search po name i description
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 📊 Sortowanie
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name');
                break;
            case 'name_desc':
                $query->orderByDesc('name');
                break;
            case 'price_buy_asc':
                $query->orderBy('price_buy');
                break;
            case 'price_buy_desc':
                $query->orderByDesc('price_buy');
                break;
            case 'price_sell_asc':
                $query->orderBy('price_sell');
                break;
            case 'price_sell_desc':
                $query->orderByDesc('price_sell');
                break;
            default:
                $query->orderBy('name');
                break;
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Lista dostawców dla <select>
        $suppliers = Supplier::orderBy('name')->pluck('name', 'id');
        return view('products.create', compact('suppliers'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produkt został dodany pomyślnie.');
    }

    public function show(Product $product)
    {
        $product->load('supplier');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::orderBy('name')->pluck('name', 'id');
        return view('products.edit', compact('product', 'suppliers'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Dane produktu zostały zaktualizowane.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Produkt został usunięty (miękko).');
    }
}
