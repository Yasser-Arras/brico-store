<x-layouts.admin>

   
 <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8 p-6 rounded-2xl bg-primary/5 border border-primary/10">

    <!-- Left text -->
    <div class="space-y-2 max-w-2xl">
        <h2 class="text-3xl font-bold text-on-surface tracking-tight">
            Dashboard
        </h2>

        <p class="text-base text-on-surface-variant leading-relaxed">
            Aperçu rapide des performances de votre magasin et de l'inventaire actuel.
        </p>
    </div>

    <!-- Right side (optional actions) -->
    <div>
        <!-- empty for now -->
    </div>

</div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Stat Card 1 - Total Products -->
        <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

            <div class="flex justify-between items-start mb-3">
                <div class="w-12 h-12 flex items-center justify-center bg-primary rounded-lg">
                    <span class="material-symbols-outlined text-white">
                        inventory_2
                    </span>
                </div>

            </div>

            <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Total Produits</p>
            <h3 class="font-headline-lg text-headline-lg">{{ $productsCount }}</h3>

            <div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-primary"></div>
            </div>
        </div>


        <!-- Stat Card 2 - Categories -->
        <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

            <div class="flex justify-between items-start mb-3">
                <div class="w-12 h-12 flex items-center justify-center bg-fouriary rounded-lg">
                    <span class="material-symbols-outlined text-white">
                        category
                    </span>
                </div>
            </div>

            <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Categories</p>
            <h3 class="font-headline-lg text-headline-lg">{{ $categoriesCount }}</h3>

            <div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-fouriary"></div>
            </div>
        </div>

        <!-- Stat Card 3 - Low Stock -->
        <div class="glass-card rounded-xl p-6 relative overflow-hidden group border-2 border-outline-variant/30">

            <div class="flex justify-between items-start mb-3">
                <div class="w-12 h-12 flex items-center justify-center bg-error rounded-lg">
                    <span class="material-symbols-outlined text-white">
                        warning
                    </span>
                </div>
            </div>

            <p class="text-outline font-label-md mb-1 uppercase tracking-wider">Low Stock Items</p>
            <h3 class="font-headline-lg text-headline-lg">{{ $lowStockCount }}</h3>

            <div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-error"></div>
            </div>
        </div>

    </div>

    <!-- Products Table Section -->
    <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">
        <div class="px-6 py-5 flex justify-between items-center bg-white/50 border-b border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm">Derniers produits ajoutés</h4>
            <a href="{{ route('admin.products.index') }}"
                class="text-primary font-label-md hover:underline flex items-center gap-1">
                Voir tout
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Produit</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-right">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse ($latestProducts as $product)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-variant overflow-hidden">
                                        @if ($product->image_path)
                                            @if (str_starts_with($product->image_path, 'http'))
                                                <img class="w-full h-full object-cover" src="{{ $product->image_path }}"
                                                    alt="{{ $product->name }}"
                                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22%3E%3Crect fill=%22%23e0e3e5%22 width=%2224%22 height=%2224%22/%3E%3C/svg%3E'">
                                            @else
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22%3E%3Crect fill=%22%23e0e3e5%22 width=%2224%22 height=%2224%22/%3E%3C/svg%3E'">
                                            @endif
                                        @else
                                            <svg class="w-full h-full text-outline-variant" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                                            </svg>
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
                                    class="px-3 py-1.5 bg-secondary-fixed text-on-secondary-fixed-variant rounded-full text-xs font-medium border border-secondary-fixed/40">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-on-background">
                                {{ number_format($product->price, 2, ',', ' ') }} MAD
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $product->stock_quantity > 10 ? 'bg-primary' : 'bg-error' }}">
                                    </div>
                                    <span class="text-body-md">{{ $product->stock_quantity }} en stock</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-on-surface-variant">
                                {{ $product->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-6 text-on-surface-variant text-center" colspan="5">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-[32px] opacity-50">inbox</span>
                                    <span>Aucun produit ajouté.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


</x-layouts.admin>