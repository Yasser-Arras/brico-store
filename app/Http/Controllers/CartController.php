<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        return view('cart.index', $this->cartViewData($request));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:' . max($product->stock_quantity, 1)],
        ]);

        $quantity = (int) ($data['quantity'] ?? 1);
        $cart = $request->session()->get('cart', []);
        $currentQuantity = (int) ($cart[$product->id] ?? 0);
        $cart[$product->id] = min($currentQuantity + $quantity, $product->stock_quantity);

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . max($product->stock_quantity, 1)],
        ]);

        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = (int) $data['quantity'];
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

    public function processing(Request $request): View
    {
        return view('cart.processing', $this->cartViewData($request));
    }
    private function generateOrderReference(): string
    {
        do {
            $reference = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        } while (Order::where('reference', $reference)->exists());

        return $reference;
    }
    public function process(Request $request): RedirectResponse
    {
       
        $data = $this->cartViewData($request);

        if ($data['items']->isEmpty()) {
            return redirect()->route('cart.processing')->with('error', 'Your cart is empty.');
        }

        foreach ($data['items'] as $item) {
            if ($item['quantity'] > $item['product']->stock_quantity) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', $item['product']->name . ' does not have enough stock.');
            }
        }

        try {
            $order = DB::transaction(function () use ($request, $data) {
                $lockedItems = collect();

                foreach ($data['items'] as $item) {
                    $product = Product::whereKey($item['product']->id)->lockForUpdate()->firstOrFail();
                    $quantity = (int) $item['quantity'];

                    if ($quantity > $product->stock_quantity) {
                        throw new RuntimeException($product->name . ' does not have enough stock.');
                    }

                    $lockedItems->push([
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $product->price * $quantity,
                    ]);
                }

                // Payment purchase handling would go here.
                // Example future workcall payment provider, verify payment status bla bla bla etc

                $order = Order::create([
                    'user_id' => $request->user()->id,
                    'reference' => $this->generateOrderReference(),
                    'status' => 'processing',
                    'total_amount' => $lockedItems->sum('subtotal'),
                    'processed_at' => now(),
                ]);

                foreach ($lockedItems as $item) {
                    $product = $item['product'];
                    $quantity = $item['quantity'];

                    $order->items()->create([
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'unit_price' => $product->price,
                        'quantity' => $quantity,
                        'subtotal' => $item['subtotal'],
                    ]);

                    $product->decrement('stock_quantity', $quantity);
                }

                return $order;
            });
        } catch (\Throwable $exception) {
            return redirect()->route('cart.index')->with('error', $exception->getMessage());
        }

        $request->session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order stored successfully.');
    }

    public function showOrder(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        return view('cart.completed', [
            'order' => $order->load('items.product'),
        ]);
    }

    private function cartViewData(Request $request): array
    {
        $cart = collect($request->session()->get('cart', []))
            ->mapWithKeys(fn($quantity, $productId) => [(int) $productId => (int) $quantity])
            ->filter(fn($quantity) => $quantity > 0);

        $products = Product::with('category')
            ->whereIn('id', $cart->keys())
            ->get()
            ->keyBy('id');

        $items = $cart->map(function (int $quantity, int $productId) use ($products) {
            $product = $products->get($productId);

            if (!$product) {
                return null;
            }

            return [
                'product' => $product,
                'quantity' => min($quantity, $product->stock_quantity),
                'subtotal' => $product->price * min($quantity, $product->stock_quantity),
            ];
        })->filter()->values();

        return [
            'items' => $items,
            'total' => $items->sum('subtotal'),
        ];
    }


}
