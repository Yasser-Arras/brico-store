<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'BricoMag - Magasin de bricolage' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Hanken Grotesk', sans-serif;
        }
    </style>
</head>

<body class="bg-stone-50 text-zinc-900 antialiased">
    <header class="border-b border-zinc-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-bold">
                <span class="grid h-10 w-10 place-items-center rounded-lg bg-emerald-700 text-white">BM</span>
                <span class="text-lg">BricoMag</span>
            </a>
            <nav class="flex items-center gap-4 text-sm font-medium text-zinc-700">
                <a class="hover:text-emerald-700" href="{{ route('home') }}">Accueil</a>
                <a class="hover:text-emerald-700" href="{{ route('products.index') }}">Catalogue</a>
                @auth
                    <a class="hover:text-emerald-700" href="{{ route('profile.edit') }}">Profil</a>
                    <a class="hover:text-emerald-700" href="{{ route('cart.index') }}">Panier</a>
                    @if (auth()->user()->isAdmin())
                        <a class="rounded-md bg-zinc-900 px-4 py-2 text-white" href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="rounded-md border border-zinc-300 px-4 py-2 hover:border-emerald-700 hover:text-emerald-700">Se déconnecter</button>
                    </form>
                @else
                    <a class="hover:text-emerald-700" href="{{ route('register') }}">Créer un compte</a>
                    <a class="rounded-md border border-zinc-300 px-4 py-2" href="{{ route('login') }}">Se connecter</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
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
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 text-sm text-zinc-600 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <p class="font-semibold text-zinc-900">BricoMag</p>
                <p class="mt-2">Outillage, peinture, jardinage et quincaillerie pour les travaux du quotidien.</p>
            </div>
            <div>
                <p class="font-semibold text-zinc-900">Adresse</p>
                <p class="mt-2">Zone artisanale, Casablanca</p>
            </div>
            <div>
                <p class="font-semibold text-zinc-900">Horaires</p>
                <p class="mt-2">Lundi au samedi, 8h30 - 19h00</p>
            </div>
        </div>
    </footer>
</body>

</html>
