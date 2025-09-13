<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('client');

        // 🔍 Wyszukiwanie po nazwie klienta lub statusie
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('client', function($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })->orWhere('status', 'like', "%{$search}%");
        }

        // 📊 Sortowanie po dacie lub statusie
        switch ($request->sort) {
            case 'date_asc':
                $query->orderBy('order_date', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('order_date', 'desc');
                break;
            case 'status_asc':
                $query->orderBy('status', 'asc');
                break;
            case 'status_desc':
                $query->orderBy('status', 'desc');
                break;
            default:
                $query->orderBy('order_date', 'desc');
                break;
        }

        $orders = $query->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients  = Client::orderBy('name')->pluck('name', 'id');
        $products = Product::orderBy('name')->pluck('name', 'id');
        return view('orders.create', compact('clients', 'products'));
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $order = Order::create([
            'client_id'  => $data['client_id'],
            'order_date' => $data['order_date'],
            'status'     => $data['status'],
        ]);

        foreach ($data['products'] as $prod) {
            $productModel = Product::findOrFail($prod['product_id']);
            $order->products()->attach($productModel->id, [
                'quantity'   => $prod['quantity'],
                'price_buy'  => $productModel->price_buy,
                'price_sell' => $productModel->price_sell,
            ]);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Zamówienie zostało utworzone.');
    }

    public function show(Order $order)
    {
        $order->load('client', 'products');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $clients  = Client::orderBy('name')->pluck('name', 'id');
        $products = Product::orderBy('name')->pluck('name', 'id');
        $order->load('products');

        $orderProducts = [];
        foreach ($order->products as $p) {
            $orderProducts[$p->id] = [
                'quantity'   => $p->pivot->quantity,
                'price_buy'  => $p->pivot->price_buy,
                'price_sell' => $p->pivot->price_sell,
            ];
        }

        return view('orders.edit', compact('order', 'clients', 'products', 'orderProducts'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();

        $order->update([
            'client_id'  => $data['client_id'],
            'order_date' => $data['order_date'],
            'status'     => $data['status'],
        ]);

        $order->products()->detach();

        if (!empty($data['products'])) {
            foreach ($data['products'] as $prod) {
                $productModel = Product::findOrFail($prod['product_id']);
                $order->products()->attach($productModel->id, [
                    'quantity'   => $prod['quantity'],
                    'price_buy'  => $productModel->price_buy,
                    'price_sell' => $productModel->price_sell,
                ]);
            }
        }

        return redirect()->route('orders.index')
            ->with('success', 'Dane zamówienia zostały zaktualizowane.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Zamówienie zostało usunięte.');
    }
}
