<x-layouts.public title="Cart - BricoMag">
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase text-emerald-700">Votre panier</p>
                <h1 class="mt-2 text-4xl font-black">Vos produits sélectionnés</h1>
            </div>
            <a class="rounded-md border border-zinc-300 px-4 py-2 font-semibold hover:border-emerald-700 hover:text-emerald-700" href="{{ route('products.index') }}">Continuer les achats</a>
        </div>

        @if ($items->isEmpty())
            <div class="rounded-lg border border-zinc-200 bg-white p-8 text-zinc-600">Votre panier est vide.</div>
        @else
            <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
                <div class="space-y-4">
                    @foreach ($items as $item)
                        @php
                            $product = $item['product'];
                            $image = $product->image_path
                                ? (str_starts_with($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path))
                                : asset('storage/products/default.jpg');
                        @endphp
                        <article class="grid gap-4 rounded-lg border border-zinc-200 bg-white p-4 shadow-sm sm:grid-cols-[120px_1fr]">
                            <img class="h-28 w-full rounded-md object-contain bg-white" src="{{ $image }}" alt="{{ $product->name }}">
                            <div class="space-y-3">
                                <div class="flex flex-wrap justify-between gap-3">
                                    <div>
                                        <h2 class="font-bold text-zinc-950">{{ $product->name }}</h2>
                                        <p class="text-sm text-zinc-500">{{ $product->category->name }}</p>
                                    </div>
                                    <p class="font-bold text-emerald-700">{{ number_format($item['subtotal'], 2, ',', ' ') }} DH</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-3">
                                    <form class="flex items-center gap-2" method="POST" action="{{ route('cart.update', $product) }}">
                                        @csrf
                                        @method('PUT')
                                        <input class="w-24 rounded-md border border-zinc-300 px-3 py-2" type="number" name="quantity" min="1" max="{{ max($product->stock_quantity, 1) }}" value="{{ $item['quantity'] }}">
                                        <button class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-semibold hover:border-emerald-700 hover:text-emerald-700">Update</button>
                                    </form>
                                    <form method="POST" action="{{ route('cart.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-bold">Résumé</h2>
                    <div class="mt-5 flex justify-between border-t border-zinc-200 pt-5 text-lg font-black">
                        <span>Total</span>
                        <span>{{ number_format($total, 2, ',', ' ') }} DH</span>
                    </div>
                    <a class="mt-6 block rounded-md bg-emerald-700 px-5 py-3 text-center font-semibold text-white hover:bg-emerald-800" href="{{ route('cart.processing') }}">Procéder au traitement</a>
                </aside>
            </div>
        @endif
    </section>
</x-layouts.public>
