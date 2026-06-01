<x-layouts.public title="BricoMag - Accueil">
    <section class="bg-white">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
            <div class="space-y-7">
                <span class="inline-flex rounded-md bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700">Magasin de bricolage a Casablanca</span>
                <div class="space-y-4">
                    <h1 class="max-w-3xl text-4xl font-black leading-tight text-zinc-950 sm:text-5xl">BricoMag</h1>
                    <p class="max-w-2xl text-lg text-zinc-600">Tout pour reparer, construire et amenager avec des produits fiables, un stock lisible et un catalogue facile a explorer.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800" href="{{ route('products.index') }}">Voir le catalogue</a>
                    <a class="rounded-md border border-zinc-300 px-5 py-3 font-semibold hover:border-emerald-700 hover:text-emerald-700" href="#presentation">Presentation</a>
                </div>
            </div>
            <img class="h-[420px] w-full rounded-lg object-cover shadow-xl" src="https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=1200&q=80" alt="Rayon outillage de magasin de bricolage">
        </div>
    </section>

    <section id="presentation" class="border-y border-zinc-200 bg-zinc-900 text-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <p class="text-3xl font-black">250+</p>
                <p class="mt-2 text-zinc-300">references disponibles en magasin.</p>
            </div>
            <div>
                <p class="text-3xl font-black">Conseil</p>
                <p class="mt-2 text-zinc-300">Une equipe orientee travaux, entretien et renovation.</p>
            </div>
            <div>
                <p class="text-3xl font-black">Stock</p>
                <p class="mt-2 text-zinc-300">Des quantites visibles pour preparer vos achats.</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase text-emerald-700">Catalogue</p>
                <h2 class="mt-2 text-3xl font-black">Derniers produits</h2>
            </div>
            <a class="rounded-md border border-zinc-300 px-4 py-2 font-semibold hover:border-emerald-700 hover:text-emerald-700" href="{{ route('products.index') }}">Tout afficher</a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <p class="rounded-md border border-zinc-200 bg-white p-6 text-zinc-600">Aucun produit pour le moment.</p>
            @endforelse
        </div>
    </section>
</x-layouts.public>
