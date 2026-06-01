<x-layouts.admin heading="Tableau de bord">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-zinc-500">Nombre total de produits</p>
            <p class="mt-2 text-4xl font-black">{{ $productsCount }}</p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-zinc-500">Nombre de categories</p>
            <p class="mt-2 text-4xl font-black">{{ $categoriesCount }}</p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-zinc-500">Derniere mise a jour</p>
            <p class="mt-2 text-2xl font-black">{{ now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <section class="mt-8 rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="flex items-center justify-between gap-4 border-b border-zinc-200 p-6">
            <h2 class="text-xl font-bold">Derniers produits ajoutes</h2>
            <a class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-800" href="{{ route('admin.products.create') }}">Ajouter</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-600">
                    <tr>
                        <th class="px-6 py-3">Produit</th>
                        <th class="px-6 py-3">Categorie</th>
                        <th class="px-6 py-3">Prix</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse ($latestProducts as $product)
                        <tr>
                            <td class="px-6 py-4 font-semibold">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category->name }}</td>
                            <td class="px-6 py-4">{{ number_format($product->price, 2, ',', ' ') }} DH</td>
                            <td class="px-6 py-4">{{ $product->stock_quantity }}</td>
                            <td class="px-6 py-4">{{ $product->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-6 text-zinc-500" colspan="5">Aucun produit ajoute.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.admin>
