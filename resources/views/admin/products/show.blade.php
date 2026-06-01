<x-layouts.admin heading="Detail du produit">
    @php
        $image = $product->image_path
            ? (str_starts_with($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path))
            : 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?auto=format&fit=crop&w=900&q=80';
    @endphp
    <div class="grid gap-6 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm lg:grid-cols-[360px_1fr]">
        <img class="h-72 w-full rounded-lg object-cover" src="{{ $image }}" alt="{{ $product->name }}">
        <div class="space-y-4">
            <p class="text-sm font-semibold text-emerald-700">{{ $product->category->name }}</p>
            <h2 class="text-3xl font-black">{{ $product->name }}</h2>
            <p class="text-zinc-600">{{ $product->description }}</p>
            <p class="text-2xl font-black text-emerald-700">{{ number_format($product->price, 2, ',', ' ') }} DH</p>
            <p class="text-sm text-zinc-500">Stock disponible: {{ $product->stock_quantity }}</p>
            <p class="text-sm text-zinc-500">Cree le {{ $product->created_at->format('d/m/Y') }}</p>
            <a class="inline-flex rounded-md border border-zinc-300 px-4 py-2 font-semibold" href="{{ route('admin.products.index') }}">Retour</a>
        </div>
    </div>
</x-layouts.admin>
