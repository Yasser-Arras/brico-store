<x-layouts.admin heading="Produits">
    <div class="mb-6 flex justify-end">
        <a class="rounded-md bg-emerald-700 px-4 py-2 font-semibold text-white hover:bg-emerald-800" href="{{ route('admin.products.create') }}">Ajouter un produit</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[920px] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-600">
                    <tr>
                        <th class="px-5 py-3">Nom</th>
                        <th class="px-5 py-3">Categorie</th>
                        <th class="px-5 py-3">Prix</th>
                        <th class="px-5 py-3">Stock</th>
                        <th class="px-5 py-3">Date de creation</th>
                        <th class="px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-5 py-4 font-semibold">{{ $product->name }}</td>
                            <td class="px-5 py-4">{{ $product->category->name }}</td>
                            <td class="px-5 py-4">{{ number_format($product->price, 2, ',', ' ') }} DH</td>
                            <td class="px-5 py-4">{{ $product->stock_quantity }}</td>
                            <td class="px-5 py-4">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a class="rounded-md border border-zinc-300 px-3 py-2 hover:border-emerald-700 hover:text-emerald-700" href="{{ route('admin.products.show', $product) }}">Voir</a>
                                    <a class="rounded-md border border-zinc-300 px-3 py-2 hover:border-emerald-700 hover:text-emerald-700" href="{{ route('admin.products.edit', $product) }}">Modifier</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border border-red-200 px-3 py-2 text-red-700 hover:bg-red-50">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-5 py-6 text-zinc-500" colspan="6">Aucun produit enregistre.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
</x-layouts.admin>
