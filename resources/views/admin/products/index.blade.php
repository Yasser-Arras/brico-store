<x-layouts.admin>
   

    <!-- Header -->
    <div class="mb-8">
       <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8 p-6 rounded-2xl bg-primary/5 border border-primary/10">

    <!-- Left text -->
    <div class="space-y-2 max-w-2xl">
        <h2 class="text-3xl font-bold text-on-surface tracking-tight">
            Produits
        </h2>

        <p class="text-base text-on-surface-variant leading-relaxed">
            Gérer les produits de votre magasin, ajouter de nouveaux articles, et suivre les stocks.
        </p>
    </div>

    <!-- Button -->
    <a href="{{ route('admin.products.create') }}"
       class="bg-primary text-on-primary px-6 py-3 rounded-xl font-label-md flex items-center gap-2
              hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95 w-fit">
        <span class="material-symbols-outlined">add_circle</span>
        Ajouter un produit
    </a>

</div>
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- Stat Card 1 - Total Products -->
            <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-primary text-white">
                        <span class="material-symbols-outlined text-[22px] leading-none">
                            inventory_2
                        </span>
                    </div>
                </div>

                <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Total Produits</p>
                <h3 class="font-headline-lg text-headline-lg">{{ $totalProducts }}</h3>
            </div>

            <!-- Stat Card 2 - Low Stock -->
            <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-error text-white">
                        <span class="material-symbols-outlined text-[22px] leading-none">
                            warning
                        </span>
                    </div>
                </div>

                <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Stock Faible</p>
                <h3 class="font-headline-lg text-headline-lg">{{ $lowStockProducts }}</h3>
            </div>

            <!-- Stat Card 3 - Total Value -->
            <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-accent text-white">
                        <span class="material-symbols-outlined text-[22px] leading-none">
                            payments
                        </span>
                    </div>
                </div>

                <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Valeur Totale</p>
                <h3 class="font-headline-lg text-headline-lg text-primary">
                    {{ number_format($totalValue, 2, ',', ' ') }} MAD
                </h3>
            </div>

            <!-- Stat Card 4 - Categories -->
            <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-fouriary text-white">
                        <span class="material-symbols-outlined text-[22px] leading-none">
                            category
                        </span>
                    </div>
                </div>

                <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Catégories</p>
                <h3 class="font-headline-lg text-headline-lg">{{ $totalCategories }}</h3>
            </div>

        </div>
    </div>

    <!-- Products Table Section -->
    <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">


        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50 align-middle">
                        <th class="px-6 py-4 align-middle font-label-md text-outline uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-4 align-middle font-label-md text-outline uppercase tracking-wider">Catégorie
                        </th>
                        <th class="px-6 py-4 align-middle font-label-md text-outline uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-4 align-middle font-label-md text-outline uppercase tracking-wider">Stock
                        </th>
                        <th class="px-6 py-4 align-middle font-label-md text-outline uppercase tracking-wider">Date de
                            création</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse ($products as $product)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-variant overflow-hidden">
                                        @if ($product->image_path)

                                            <img class="w-full h-full object-cover"
                                                src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">

                                        @else
                                            <img class="w-full h-full object-cover"
                                                src="{{ asset('storage/products/default.png') }}" alt="{{ $product->name }}">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-body-md font-bold text-on-background">{{ $product->name }}</p>
                                        <p class="text-xs text-outline">SKU: {{ strtoupper(substr($product->slug, 0, 6)) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
    class="inline-flex items-center rounded-full bg-primary/15 px-3 py-1 text-xs font-medium text-primary">
    {{ $product->category->name }}
</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-on-background">
                                {{ number_format($product->price, 2, ',', ' ') }} MAD
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $product->stock_quantity > 10 ? 'bg-primary' : 'bg-error' }}">
                                    </div>
                                    <span class="text-body-md">{{ $product->stock_quantity }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                        title="Voir">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors"
                                        title="Modifier">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors"
                                            title="Supprimer">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-12 text-on-surface-variant text-center" colspan="6">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">inbox</span>
                                    <span class="text-body-md">Aucun produit enregistré.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/10">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>