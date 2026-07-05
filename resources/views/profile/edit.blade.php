<x-layouts.public title="Profile - BricoMag">
    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-black">Mon profil</h1>
            <p class="mt-2 text-sm text-zinc-600">Mettez a jour vos informations de livraison et de contact.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
            <form class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-semibold">Nom</span>
                        <input
                            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold">Email</span>
                        <input
                            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold">Telephone</span>
                        <input
                            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            required
                        >
                        @error('phone') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold">Adresse</span>
                        <input
                            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
                            name="address"
                            value="{{ old('address', $user->address) }}"
                            required
                        >
                        @error('address') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">
                        Enregistrer
                    </button>
                    <a class="rounded-md border border-zinc-300 px-5 py-3 font-semibold hover:border-emerald-700 hover:text-emerald-700" href="{{ route('home') }}">
                        Annuler
                    </a>
                </div>
            </form>

            <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-black">Mot de passe</h2>
                <p class="mt-2 text-sm text-zinc-600">Recevez un lien par email pour choisir un nouveau mot de passe.</p>

                <form class="mt-5" method="POST" action="{{ route('profile.password.email') }}">
                    @csrf
                    <button class="w-full rounded-md border border-zinc-300 px-5 py-3 font-semibold hover:border-emerald-700 hover:text-emerald-700">
                        Envoyer le lien
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.public>
