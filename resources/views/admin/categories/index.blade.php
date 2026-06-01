<x-layouts.admin heading="Categories">
    <div class="mb-6 flex justify-end">
        <a class="rounded-md bg-emerald-700 px-4 py-2 font-semibold text-white hover:bg-emerald-800" href="{{ route('admin.categories.create') }}">Ajouter une categorie</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-zinc-50 text-zinc-600">
                <tr>
                    <th class="px-5 py-3">Nom</th>
                    <th class="px-5 py-3">Description</th>
                    <th class="px-5 py-3">Produits</th>
                    <th class="px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $category->name }}</td>
                        <td class="px-5 py-4 text-zinc-600">{{ $category->description ?: 'Aucune description' }}</td>
                        <td class="px-5 py-4">{{ $category->products_count }}</td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-2">
                                <a class="rounded-md border border-zinc-300 px-3 py-2 hover:border-emerald-700 hover:text-emerald-700" href="{{ route('admin.categories.edit', $category) }}">Modifier</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette categorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-md border border-red-200 px-3 py-2 text-red-700 hover:bg-red-50">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-5 py-6 text-zinc-500" colspan="4">Aucune categorie enregistree.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $categories->links() }}</div>
</x-layouts.admin>
