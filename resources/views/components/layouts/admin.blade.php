<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BricoMag Admin Console' }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600;700&family=Manrope:wght@400;500;600&family=Geist:wght@400;500&display=swap" rel="stylesheet">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-card {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md selection:bg-primary-container selection:text-on-primary-container">
    <!-- SideNavBar -->
    <aside class="fixed h-full w-[280px] left-0 top-0 bg-on-background flex flex-col py-6 shadow-lg z-50">
        <div class="px-6 mb-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center text-on-primary-container overflow-hidden">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
            </div>
            <div>
                <h1 class="font-headline-md text-headline-md font-bold text-primary-fixed leading-none">BricoMag</h1>
                <p class="font-label-md text-label-md text-surface-variant opacity-60">Admin Console</p>
            </div>
        </div>
        
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container text-on-primary-container border-l-4 border-primary' : 'text-white hover:text-white hover:bg-on-surface-variant rounded-r-lg' }} transition-colors cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" style="{{ request()->routeIs('admin.dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
                <span class="font-body-md text-body-md">Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-primary-container text-on-primary-container border-l-4 border-primary' : 'text-white hover:text-white hover:bg-on-surface-variant rounded-r-lg' }} transition-colors cursor-pointer active:scale-95">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="font-body-md text-body-md">Produits</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'bg-primary-container text-on-primary-container border-l-4 border-primary' : 'text-white hover:text-white hover:bg-on-surface-variant rounded-r-lg' }} transition-colors cursor-pointer active:scale-95">
                <span class="material-symbols-outlined">category</span>
                <span class="font-body-md text-body-md">Catégories</span>
            </a>
             <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-primary-container text-on-primary-container border-l-4 border-primary' : 'text-white hover:text-white hover:bg-on-surface-variant rounded-r-lg' }} transition-colors cursor-pointer active:scale-95">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="font-body-md text-body-md">Commandes</span>
            </a>
             <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-primary-container text-on-primary-container border-l-4 border-primary' : 'text-white hover:text-white hover:bg-on-surface-variant rounded-r-lg' }} transition-colors cursor-pointer active:scale-95">
                <span class="material-symbols-outlined">people</span>
                <span class="font-body-md text-body-md">Utilisateurs</span>
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 text-white hover:text-white hover:bg-on-surface-variant transition-colors cursor-pointer rounded-r-lg active:scale-95">
                <span class="material-symbols-outlined">public</span>
                <span class="font-body-md text-body-md">Voir le site</span>
            </a>
            
        </nav>
        
        <div class="px-4 mt-auto space-y-1">
            <a href="{{ route('admin.products.create') }}" class="w-full mb-5 bg-primary text-white py-3 rounded-xl font-body-md flex items-center justify-center gap-2 hover:bg-primary/90 transition-all active:scale-95">
                <span class="material-symbols-outlined">add</span>
                Nouveau produit
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error/10 transition-colors cursor-pointer rounded-r-lg">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body-md text-body-md">Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Canvas -->
    <main class="ml-[280px] pt-16 min-h-screen">
        <div class="max-w-[1440px] mx-auto p-8 animate-in fade-in duration-700">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-primary/10 border border-primary/20 px-4 py-3 text-sm text-primary font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
           @if (session('error'))
                <div class="mb-6 rounded-lg bg-error/10 border border-error/20 px-4 py-3 text-sm text-error font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">error</span>
                    {{ session('error') }}
                </div>
            @endif
            
            {{ $slot }}
        </div>
    </main>

    <script>
        // Glass card hover effect
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });
    </script>
</body>
</html>
