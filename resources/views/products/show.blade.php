<x-layouts.public title="{{ $product->name }} - BricoMag">
    @php
        $image = $product->image_path
            ? (str_starts_with($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path))
            : 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?auto=format&fit=crop&w=900&q=80';
    @endphp
    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-2 lg:px-8">
        <img class="h-[520px] w-full rounded-lg object-cover shadow-lg" src="{{ $image }}" alt="{{ $product->name }}">
        <div class="space-y-6">
            <a class="text-sm font-semibold text-emerald-700" href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            <div>
                <h1 class="text-4xl font-black">{{ $product->name }}</h1>
                <p class="mt-4 text-lg leading-8 text-zinc-600">{{ $product->description }}</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-lg border border-zinc-200 bg-white p-5">
                    <p class="text-sm text-zinc-500">Prix</p>
                    <p class="mt-1 text-3xl font-black text-emerald-700">{{ number_format($product->price, 2, ',', ' ') }} DH</p>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-5">
                    <p class="text-sm text-zinc-500">Stock disponible</p>
                    <p class="mt-1 text-3xl font-black">{{ $product->stock_quantity }}</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                @auth
                    <form class="flex gap-3" method="POST" action="{{ route('cart.store', $product) }}">
                        @csrf
                        <input class="w-24 rounded-md border border-zinc-300 px-3 py-3 outline-none focus:border-emerald-700" type="number" name="quantity" min="1" max="{{ max($product->stock_quantity, 1) }}" value="1">
                        <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800" @disabled($product->stock_quantity < 1)>Add to cart</button>
                    </form>
                @else
                    <a class="inline-flex rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800" href="{{ route('login') }}">Sign in to add to cart</a>
                @endauth
                <a class="inline-flex rounded-md bg-zinc-900 px-5 py-3 font-semibold text-white hover:bg-emerald-700" href="{{ route('products.index') }}">Retour au catalogue</a>
            </div>
        </div>
    </section>
</x-layouts.public>
