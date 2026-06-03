<x-layouts.public title="Processing cart - BricoMag">
    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-zinc-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase text-emerald-700">Procéder au traitement</p>
            <h1 class="mt-2 text-4xl font-black">Vérifiez votre panier</h1>
            <p class="mt-3 text-zinc-600">Cette page de traitement démontre le contenu de votre panier avant la confirmation.</p>

            @isset($emptyMessage)
                <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $emptyMessage }}</div>
            @endisset
@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 p-4 text-red-700">
        {{ $errors->first() }}
    </div>
@endif
            @if ($items->isNotEmpty())
                <div class="mt-8 divide-y divide-zinc-200 border-y border-zinc-200">
                    @foreach ($items as $item)
                        <div class="flex justify-between gap-4 py-4">
                            <div>
                                <p class="font-semibold">{{ $item['product']->name }}</p>
                                <p class="text-sm text-zinc-500">Quantity: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-bold">{{ number_format($item['subtotal'], 2, ',', ' ') }} DH</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 flex items-center justify-between text-xl font-black">
                    <span>Total</span>
                    <span>{{ number_format($total, 2, ',', ' ') }} DH</span>
                </div>
                <form class="mt-8" method="POST" action="{{ route('cart.process') }}">
                    @csrf
                    <button type="submit" class="w-full rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Confirmer le traitement</button>
                </form>
            @else
                <a class="mt-8 inline-flex rounded-md bg-zinc-900 px-5 py-3 font-semibold text-white hover:bg-emerald-700" href="{{ route('products.index') }}">Aller au catalogue</a>
            @endif
        </div>
    </section>
</x-layouts.public>
