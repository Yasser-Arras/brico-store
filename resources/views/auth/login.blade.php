<x-layouts.public title="Se connecter - BricoMag">
    <section class="mx-auto grid min-h-[70vh] max-w-7xl place-items-center px-4 py-12 sm:px-6 lg:px-8">
        <form class="w-full max-w-md rounded-lg border border-zinc-200 bg-white p-8 shadow-sm" method="POST" action="{{ route('login.store') }}">
            @csrf
            <h1 class="text-3xl font-black">Se connecter</h1>
            <p class="mt-2 text-sm text-zinc-600">Accédez à votre panier. Les comptes admin seront redirigés vers le tableau de bord.</p>
            <div class="mt-6 space-y-4">
                <label class="block">
                    <span class="text-sm font-semibold">Email</span>
                    <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Mot de passe</span>
                    <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" type="password" name="password" required>
                    @error('password') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <div class="text-right text-sm">
                    <a class="font-semibold text-emerald-700" href="{{ route('password.request') }}">Mot de passe oublie ?</a>
                </div>
                <label class="flex items-center gap-2 text-sm text-zinc-600">
                    <input class="rounded border-zinc-300 text-emerald-700" type="checkbox" name="remember" value="1">
                    Se souvenir de moi
                </label>
                <button class="w-full rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Se connecter</button>
                <p class="text-center text-sm text-zinc-600">Pas de compte ? <a class="font-semibold text-emerald-700" href="{{ route('register') }}">Créer un compte</a></p>
            </div>
        </form>
    </section>
</x-layouts.public>
