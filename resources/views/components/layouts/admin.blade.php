<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Administration BricoMag' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-100 text-zinc-900 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="bg-zinc-950 text-white lg:fixed lg:inset-y-0 lg:w-72">
            <div class="flex items-center justify-between px-6 py-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 font-bold">
                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-emerald-500 text-zinc-950">BM</span>
                    <span>Admin BricoMag</span>
                </a>
            </div>
            <nav class="grid gap-1 px-4 pb-6 text-sm">
                <a class="rounded-md px-4 py-3 hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                <a class="rounded-md px-4 py-3 hover:bg-white/10 {{ request()->routeIs('admin.products.*') ? 'bg-white/10' : '' }}" href="{{ route('admin.products.index') }}">Produits</a>
                <a class="rounded-md px-4 py-3 hover:bg-white/10 {{ request()->routeIs('admin.categories.*') ? 'bg-white/10' : '' }}" href="{{ route('admin.categories.index') }}">Categories</a>
                <a class="rounded-md px-4 py-3 hover:bg-white/10" href="{{ route('home') }}">Voir le site</a>
            </nav>
            <form class="px-4" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full rounded-md bg-white px-4 py-3 text-left text-sm font-semibold text-zinc-950 hover:bg-emerald-100">Deconnexion</button>
            </form>
        </aside>

        <div class="flex-1 lg:ml-72">
            <header class="border-b border-zinc-200 bg-white px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-sm text-zinc-500">Espace administrateur</p>
                        <h1 class="text-2xl font-bold">{{ $heading ?? 'Tableau de bord' }}</h1>
                    </div>
                    <p class="text-sm text-zinc-600">{{ auth()->user()->name }}</p>
                </div>
            </header>
            <main class="px-4 py-8 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                @endif
                @if ($errors->has('category'))
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first('category') }}</div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
