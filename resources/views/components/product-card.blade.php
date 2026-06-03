@props(['product'])

@php
    $image = $product->image_path
        ? (str_starts_with($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path))
        : asset('storage/products/default.jpg');
@endphp

<article class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
    <a href="{{ route('products.show', $product) }}">
        <img class="h-52 w-full object-contain bg-white" src="{{ $image }}" alt="{{ $product->name }}">
    </a>

    <div class="space-y-3 p-5">
        <div class="flex items-center justify-between gap-3">
            <span class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">{{ $product->category->name }}</span>
            <span class="text-sm text-zinc-500">{{ $product->stock_quantity }} en stock</span>
        </div>

        <h3 class="text-lg font-bold text-zinc-950">{{ $product->name }}</h3>
        <p class="line-clamp-2 text-sm text-zinc-600">{{ $product->description }}</p>

        <div class="flex items-center justify-between gap-3">
            <p class="text-xl font-bold text-emerald-700">{{ number_format($product->price, 2, ',', ' ') }} DH</p>
            <a class="rounded-md bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700" href="{{ route('products.show', $product) }}">Détails</a>
        </div>

        @auth
            <form method="POST" action="{{ route('cart.store', $product) }}">
                @csrf
                <button class="w-full rounded-md border border-emerald-700 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-50" @disabled($product->stock_quantity < 1)>Ajouter au panier</button>
            </form>
        @else
            <a class="block w-full rounded-md border border-zinc-300 px-4 py-2 text-center text-sm font-semibold hover:border-emerald-700 hover:text-emerald-700" href="{{ route('login') }}">Se connecter pour ajouter au panier</a>
        @endauth
    </div>
</article>
