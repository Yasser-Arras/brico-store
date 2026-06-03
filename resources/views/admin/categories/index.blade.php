<x-layouts.admin>
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 p-6 rounded-2xl bg-primary/5 border border-primary/10">

    <!-- Left text -->
    <div class="space-y-2 max-w-2xl">
        <h2 class="text-3xl font-bold text-on-surface tracking-tight">
            Catégories
        </h2>

        <p class="text-base text-on-surface-variant leading-relaxed">
            Gérer les catégories de produits pour organiser votre inventaire.
        </p>
    </div>

    <!-- Button -->
    <a href="{{ route('admin.categories.create') }}"
       class="bg-primary text-on-primary px-6 py-3 rounded-xl font-label-md flex items-center gap-2
              hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95 w-fit">
        <span class="material-symbols-outlined">add_circle</span>
        Ajouter une catégorie
    </a>

</div>
    </div>

    <!-- Horizontal Scrollable Categories Bar -->
@if ($categories->count() > 0)
<div class="mb-8">

    <!-- Title -->
    <div class="flex items-center gap-2 mb-4">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">
            Catégories Principales
        </h3>

        <span class="text-label-md text-on-surface-variant">
            ({{ $categories->count() }})
        </span>
    </div>

    <!-- Scroll container -->
    <div class="overflow-x-auto pb-3">
        <div class="flex gap-4 min-w-max">

            @foreach ($categories as $category)
                <div class="glass-card rounded-xl p-5 min-w-[220px]
                            flex flex-col text-center items-center
                            shadow-sm hover:shadow-md transition">

                    <!-- Name -->
                   <h4 class="text-headline-md font-bold text-on-surface">
    {{ $category->name }}
</h4>

                    <!-- Divider -->
                    <div class="w-12 h-[2px] bg-surface-variant rounded-full "></div>

                    <!-- Product count -->
                    <div class="flex items-baseline gap-1 mb-3">
                        <span class="text-3xl font-bold text-primary">
                            {{ $category->products_count }}
                        </span>
                        <span class="text-label-md text-on-surface-variant">
                            produits
                        </span>
                    </div>

                    <!-- Divider -->
                    <div class="w-full h-px bg-outline-variant/30 mb-3"></div>

                    <!-- Price -->
                    <div class="text-body-md font-semibold text-on-surface">
                        {{ number_format($category->total_value, 2, ',', ' ') }} MAD
                    </div>

                </div>
            @endforeach

        </div>
    </div>

</div>
@endif

    <!-- Categories Table Section -->
    <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">
        <div class="px-6 py-5 bg-white/50 border-b border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm">Tous les catégories</h4>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Total Produits</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">Valeur Totale</th>
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-body-md font-bold text-on-background">{{ $category->name }}</p>
                                @if ($category->description)
                                    <p class="text-xs text-outline line-clamp-1">{{ $category->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 bg-primary/10 rounded-full text-sm font-bold text-primary">
                                        {{ $category->products_count }}
                                    </span>
                                    <span
                                        class="text-body-md">{{ $category->products_count === 1 ? 'produit' : 'produits' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="font-medium text-on-background">{{ number_format($category->total_value, 2, ',', ' ') }}
                                    MAD</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors"
                                        title="Modifier">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
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
                            <td class="px-6 py-12 text-on-surface-variant text-center" colspan="4">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">inbox</span>
                                    <span class="text-body-md">Aucune catégorie enregistrée.</span>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="mt-2 text-primary font-label-md hover:underline inline-flex items-center gap-1">
                                        Créer la première catégorie
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>