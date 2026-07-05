<x-layouts.public title="Forgot password - BricoMag">
    <section class="mx-auto grid min-h-[70vh] max-w-7xl place-items-center px-4 py-12 sm:px-6 lg:px-8">
        <form class="w-full max-w-md rounded-lg border border-zinc-200 bg-white p-8 shadow-sm" method="POST" action="{{ route('password.email') }}">
            @csrf
            <h1 class="text-3xl font-black">Mot de passe oublie</h1>
            <p class="mt-2 text-sm text-zinc-600">Entrez votre email et nous vous enverrons un lien pour creer un nouveau mot de passe.</p>

            <div class="mt-6 space-y-4">
                <label class="block">
                    <span class="text-sm font-semibold">Email</span>
                    <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>

                <button class="w-full rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Envoyer le lien</button>
                <p class="text-center text-sm text-zinc-600">
                    <a class="font-semibold text-emerald-700" href="{{ route('login') }}">Retour a la connexion</a>
                </p>
            </div>
        </form>
    </section>
</x-layouts.public>
