<x-layouts.public title="Register - BricoMag">
    <section class="mx-auto grid min-h-[70vh] max-w-7xl place-items-center px-4 py-12 sm:px-6 lg:px-8">
        <form class="w-full max-w-md rounded-lg border border-zinc-200 bg-white p-8 shadow-sm" method="POST"
            action="{{ route('register.store') }}">
            @csrf
            <h1 class="text-3xl font-black">Créer un compte</h1>
            <p class="mt-2 text-sm text-zinc-600">Inscrivez-vous pour ajouter des produits à votre panier et continuer la commande.</p>
            <div class="mt-6 space-y-4">
                <label class="block">
                    <span class="text-sm font-semibold">Nom</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Email</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Téléphone</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        type="text" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Address</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        type="text" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Mot de passe</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        type="password" name="password" required>
                    @error('password') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Confirmer mot de passe</span>
                    <input
                        class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                        type="password" name="password_confirmation" required>
                </label>
                <button
                    class="w-full rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Create
                    account</button>
                <p class="text-center text-sm text-zinc-600">Déjà inscrit? <a
                        class="font-semibold text-emerald-700" href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </form>
    </section>
</x-layouts.public>