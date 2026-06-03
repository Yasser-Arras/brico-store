<x-layouts.public title="Order {{ $order->reference }} - BricoMag">
    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-zinc-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase text-emerald-700">Commande confirmée</p>
            <div class="mt-2 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-black">Traitement confirmé</h1>
                    <p class="mt-2 text-zinc-600">Référence: <span class="font-semibold text-zinc-900">{{ $order->reference }}</span></p>
                </div>
                <span class="rounded-md bg-emerald-50 px-3 py-2 text-sm font-semibold text-emerald-700">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="mt-8 divide-y divide-zinc-200 border-y border-zinc-200">
                @foreach ($order->items as $item)
                    <div class="flex justify-between gap-4 py-4">
                        <div>
                            <p class="font-semibold">{{ $item->product_name }}</p>
                            <p class="text-sm text-zinc-500">{{ $item->quantity }} x {{ number_format($item->unit_price, 2, ',', ' ') }} DH</p>
                        </div>
                        <p class="font-bold">{{ number_format($item->subtotal, 2, ',', ' ') }} DH</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between text-xl font-black">
                <span>Total</span>
                <span>{{ number_format($order->total_amount, 2, ',', ' ') }} DH</span>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">
                <a class="inline-flex rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800" href="{{ route('products.index') }}">Aller au catalogue</a>
                <a class="inline-flex rounded-md border border-zinc-300 px-5 py-3 font-semibold hover:border-emerald-700 hover:text-emerald-700" href="{{ route('home') }}">Accueil</a>
            </div>
        </div>
    </section>
</x-layouts.public>
