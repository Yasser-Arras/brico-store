@csrf
<div class="space-y-5">
    <label class="block">
        <span class="text-sm font-semibold">Nom</span>
        <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block">
        <span class="text-sm font-semibold">Description</span>
        <textarea class="mt-1 min-h-32 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" name="description">{{ old('description', $category->description) }}</textarea>
        @error('description') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">{{ $button }}</button>
    <a class="rounded-md border border-zinc-300 px-5 py-3 font-semibold" href="{{ route('admin.categories.index') }}">Annuler</a>
</div>
