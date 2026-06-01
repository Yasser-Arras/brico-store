<x-layouts.public title="BricoMag - L'Outillage d'Excellence à Casablanca">
    <!-- Hero Section -->
    <section class="relative bg-surface-container-lowest overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-20 md:py-32">
            <div class="z-10 order-2 md:order-1">
                <span
                    class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 font-semibold text-xs mb-6 rounded"
                    style="font-family: 'Hanken Grotesk', sans-serif; letter-spacing: 0.1em;">
                    MAGASIN DE BRICOLAGE À CASABLANCA
                </span>
                <h1 class="text-5xl md:text-6xl font-black text-emerald-900 mb-6 leading-tight"
                    style="font-family: 'Hanken Grotesk', sans-serif;">BricoMag</h1>
                <p class="text-lg text-gray-700 mb-10 max-w-lg leading-relaxed"
                    style="font-family: 'Inter', sans-serif;">
                    Tout pour réparer, construire et aménager avec des produits fiables, un stock lisible et un
                    catalogue facile à explorer. L'excellence au service de vos projets.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}"
                        class="px-10 py-4 bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition-all active:scale-95 shadow-lg shadow-emerald-700/10 rounded"
                        style="font-family: 'Hanken Grotesk', sans-serif;">
                        Voir le catalogue
                    </a>
                    <a href="#presentation"
                        class="px-10 py-4 border border-emerald-700 text-emerald-700 font-bold hover:bg-emerald-50 transition-all active:scale-95 rounded"
                        style="font-family: 'Hanken Grotesk', sans-serif;">
                        Présentation
                    </a>
                </div>
            </div>
            <div class="relative order-1 md:order-2 h-96 md:h-96 rounded overflow-hidden group">
                <img alt="BricoMag Hero"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    src="{{ asset('storage/imgs/store.png') }}" />
            </div>
        </div>
    </section>

    <!-- Stats/Values -->
    <section id="presentation" class="bg-emerald-900 py-24 text-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 items-start">

                <div class="space-y-4 flex flex-col">
                    <div class="h-20 flex items-center">
                        <span class="text-6xl font-black text-emerald-100 leading-none block">
                            250+
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-white" style="font-family: 'Hanken Grotesk', sans-serif;">
                        Références
                    </h3>

                    <p class="text-emerald-100/80 leading-relaxed">
                        Une sélection rigoureuse de produits professionnels disponibles immédiatement en magasin.
                    </p>
                </div>

                <div class="space-y-4 flex flex-col">
                    <div class="h-19 flex items-center">
                        <span style="font-size:70px;"
                            class="material-symbols-outlined text-[88px] text-emerald-100 leading-none">
                            support_agent
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-white" style="font-family: 'Hanken Grotesk', sans-serif;">
                        Conseil
                    </h3>

                    <p class="text-emerald-100/80 leading-relaxed">
                        Une équipe d'experts dédiée pour orienter vos travaux, entretien et projets de rénovation.
                    </p>
                </div>

                <div class="space-y-4 flex flex-col">
                    <div class="h-19 flex items-center">
                        <span style="font-size:70px;"
                            class="material-symbols-outlined text-[88px] text-emerald-100 leading-none">
                            inventory_2
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-white" style="font-family: 'Hanken Grotesk', sans-serif;">
                        Stock
                    </h3>

                    <p class="text-emerald-100/80 leading-relaxed">
                        Des quantités visibles en temps réel pour préparer vos achats en toute sérénité.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Product Grid Section -->
    <section class="py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <span class="font-semibold text-xs text-gray-500 uppercase tracking-wider block mb-2"
                        style="font-family: 'Hanken Grotesk', sans-serif; letter-spacing: 0.1em;">Catalogue</span>
                    <h2 class="text-4xl font-black text-gray-900" style="font-family: 'Hanken Grotesk', sans-serif;">
                        Derniers produits</h2>
                </div>
                <a href="{{ route('products.index') }}"
                    class="px-6 py-3 border border-gray-300 hover:border-emerald-700 transition-colors font-semibold text-gray-900 hover:text-emerald-700 flex items-center gap-2 rounded"
                    style="font-family: 'Hanken Grotesk', sans-serif;">
                    Tout afficher
                    <span class="material-symbols-outlined text-lg">north_east</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="rounded-md border border-gray-200 bg-white p-6 text-gray-600">Aucun produit pour le moment.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Newsletter / Contact Teaser -->
    <section class="py-24 border-t border-gray-200 bg-white">
        <div class="max-w-2xl mx-auto px-8 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-6" style="font-family: 'Hanken Grotesk', sans-serif;">Prêt
                pour votre prochain bricole ?</h3>
            <p class="text-gray-600 mb-10 leading-relaxed" style="font-family: 'Inter', sans-serif;">Inscrivez-vous à
                notre newsletter pour recevoir des conseils d'experts et nos dernières promotions en avant-première.</p>
            <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto" method="POST" action="#">
                @csrf
                <input
                    class="flex-grow border-0 border-b border-gray-300 focus:border-emerald-700 focus:ring-0 px-4 py-3 bg-transparent font-semibold text-sm"
                    placeholder="Votre email" type="email" style="font-family: 'Hanken Grotesk', sans-serif;"
                    required />
                <button type="submit"
                    class="bg-emerald-700 text-white px-8 py-3 font-bold hover:bg-emerald-800 transition-all rounded whitespace-nowrap"
                    style="font-family: 'Hanken Grotesk', sans-serif;">S'inscrire</button>
            </form>
        </div>
    </section>

    <script>
        // Subtle scroll reveal effect
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('[data-observe]').forEach(card => {
            card.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(card);
        });
    </script>
</x-layouts.public>