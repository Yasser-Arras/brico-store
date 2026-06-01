@csrf
<div class="grid gap-5 md:grid-cols-2">
    <label class="block">
        <span class="text-sm font-semibold">Nom</span>
        <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" name="name" value="{{ old('name', $product->name) }}" required>
        @error('name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block">
        <span class="text-sm font-semibold">Categorie</span>
        <select class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" name="category_id" required>
            <option value="">Selectionner</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block">
        <span class="text-sm font-semibold">Prix</span>
        <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required>
        @error('price') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block">
        <span class="text-sm font-semibold">Quantite en stock</span>
        <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        @error('stock_quantity') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-semibold">Image</span>
        <input class="mt-1 w-full rounded-md border border-zinc-300 px-4 py-3 file:mr-4 file:rounded-md file:border-0 file:bg-zinc-900 file:px-4 file:py-2 file:text-white" type="file" name="image" accept="image/*" @required(! $product->exists)>
        @error('image') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-semibold">Description</span>
        <textarea class="mt-1 min-h-36 w-full rounded-md border border-zinc-300 px-4 py-3 outline-none focus:border-emerald-700" name="description" required>{{ old('description', $product->description) }}</textarea>
        @error('description') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">{{ $button }}</button>
    <a class="rounded-md border border-zinc-300 px-5 py-3 font-semibold" href="{{ route('admin.products.index') }}">Annuler</a>
</div>
