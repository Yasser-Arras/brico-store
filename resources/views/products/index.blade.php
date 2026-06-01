<x-layouts.public title="Catalogue - BricoMag">
    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase text-emerald-700">Catalogue</p>
                <h1 class="mt-2 text-4xl font-black">Produits disponibles</h1>
            </div>
            <form class="grid gap-3 rounded-lg border border-zinc-200 bg-zinc-50 p-4 md:grid-cols-[1fr_240px_auto]" method="GET" action="{{ route('products.index') }}">
                <input class="rounded-md border border-zinc-300 bg-white px-4 py-3 outline-none focus:border-emerald-700" type="search" name="search" value="{{ $search }}" placeholder="Rechercher par nom">
                <select class="rounded-md border border-zinc-300 bg-white px-5 py-3 outline-none focus:border-emerald-700" name="category">
                    <option value="">Toutes les categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @selected($selectedCategory === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Rechercher</button>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="rounded-lg border border-zinc-200 bg-white p-8 text-zinc-600 sm:col-span-2 lg:col-span-3">Aucun produit ne correspond a votre recherche.</div>
            @endforelse
        </div>
        <div class="mt-8">{{ $products->links() }}</div>
    </section>
</x-layouts.public>
