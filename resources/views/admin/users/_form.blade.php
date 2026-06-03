@csrf

<div class="grid gap-5 md:grid-cols-2">

    <!-- NAME -->
    <label class="block">
        <span class="text-sm font-semibold">Nom</span>
        <input
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
        >
        @error('name')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

    <!-- EMAIL -->
    <label class="block">
        <span class="text-sm font-semibold">Email</span>
        <input
            type="email"
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
        >
        @error('email')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

    <!-- PHONE -->
    <label class="block">
        <span class="text-sm font-semibold">Téléphone</span>
        <input
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="phone"
            value="{{ old('phone', $user->phone) }}"
        >
        @error('phone')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

    <!-- ROLE -->
    <label class="block">
        <span class="text-sm font-semibold">Rôle</span>
        <select
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="role"
            required
        >
            <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
            <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
        </select>

        @error('role')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

    <!-- ADDRESS -->
    <label class="block md:col-span-2">
        <span class="text-sm font-semibold">Adresse</span>
        <input
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="address"
            value="{{ old('address', $user->address) }}"
        >
        @error('address')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

    <!-- PASSWORD -->
    <label class="block md:col-span-2">
        <span class="text-sm font-semibold">Mot de passe (laisser vide si inchangé)</span>
        <input
            type="password"
            class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700"
            name="password"
        >
        @error('password')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </label>

</div>

<!-- ACTIONS -->
<div class="mt-6 flex flex-wrap gap-3">

    <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">
        {{ $button ?? 'Enregistrer' }}
    </button>

    <a class="rounded-md border border-zinc-300 px-5 py-3 font-semibold"
       href="{{ route('admin.users.index') }}">
        Annuler
    </a>

</div>