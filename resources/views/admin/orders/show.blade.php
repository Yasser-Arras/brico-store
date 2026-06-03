<x-layouts.admin>
<style>
@media print {
    body * {
        visibility: hidden !important;
    }

    #print-area,
    #print-area * {
        visibility: visible !important;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 20px;
    }

    /* keep colors (important for Tailwind) */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .no-print {
        display: none !important;
    }
}
</style>
    <!-- HEADER -->
    <div class="flex flex-col gap-6 mb-8">
       
<div id="print-area"  class="space-y-8">
        <!-- Top identity row -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

            <div>
                <div class="mb-2">
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-primary">Orders</a>
                    <span class="mx-2">/</span>
                    <span class="font-semibold text-black">{{ $order->reference }}</span>


                </div>
                <div class="flex items-center gap-3">

                    <span class="px-3 rounded-full text-caption-xs font-bold uppercase tracking-wider border
    {{ $order->status === 'done'
    ? 'bg-primary/10 text-primary border-primary/20'
    : 'bg-yellow-100 text-yellow-700 border-yellow-300' }}">

                        {{ ucfirst($order->status) }}
                    </span>

                    <div class="flex items-center gap-1.5 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        <span class="text-body-sm">
                            {{ $order->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button 
                    class="px-4 py-2 border border-outline-variant text-on-surface-variant font-label-md rounded-lg flex items-center gap-2 hover:bg-surface-container-low transition-colors"  onclick="window.print()">
                    <span class="material-symbols-outlined text-[18px]">print</span>
                    Imprimer
                </button>

                <form method="POST" action="{{ route('admin.orders.toggle-status', $order) }}">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="px-6 py-2 rounded-lg flex items-center gap-2 font-label-md transition-all
        {{ $order->status === 'processing'
    ? 'bg-green-600 text-white hover:bg-green-700'
    : 'bg-yellow-500 text-white hover:bg-yellow-600' }}">

                        <span class="material-symbols-outlined text-[18px]">
                            {{ $order->status === 'processing' ? 'check_circle' : 'restart_alt' }}
                        </span>

                        {{ $order->status === 'processing' ? 'Mark as done' : 'Reopen' }}
                    </button>
                </form>
            </div>

        </div>


        <!-- INFO CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">

            <!-- CLIENT -->
            <div class="glass-card rounded-xl p-5 border border-outline-variant/20 bg-surface-container-lowest h-full">

                <div class="flex justify-between items-start mb-3">
                    <p class="text-label-md text-on-surface-variant uppercase">Client</p>

                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]">person</span>
                    </div>
                </div>

                <div class="w-10 h-[2px] bg-primary/20 rounded-full mb-3"></div>

                <h3 class="text-headline-md font-bold text-on-surface">
                    {{ $order->user->name }}
                </h3>

                <p class="text-body-sm mt-2">
                    <span class="text-on-surface-variant">Email :</span>
                    <span class="font-medium">{{ $order->user->email }}</span>
                </p>

                <p class="text-body-sm">
                    <span class="text-on-surface-variant">Phone :</span>
                    <span class="font-medium">{{ $order->user->phone ?? 'N/A' }}</span>
                </p>

            </div>

            <!-- TOTAL -->
            <div class="glass-card rounded-xl p-5 border border-primary/20 bg-primary/10 h-full">

                <div class="flex justify-between items-start mb-3">
                    <p class="text-label-md text-on-surface-variant uppercase">Total</p>

                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white">
                        <span class="material-symbols-outlined text-[22px]">payments</span>
                    </div>
                </div>

                <!-- divider (RESTORED) -->
                <div class="w-10 h-[2px] bg-white/30 rounded-full mb-3"></div>

                <h3 class="text-headline-lg font-bold text-primary">
                    {{ number_format($order->total_amount, 2, ',', ' ') }} MAD
                </h3>

                <p class="text-body-sm text-on-surface-variant mt-2">
                    {{ $order->items->count() }} article(s)
                </p>

            </div>

            <!-- ADDRESS -->
            <div class="glass-card rounded-xl p-5 border border-outline-variant/20 bg-surface-container-lowest h-full">

                <div class="flex justify-between items-start mb-3">
                    <p class="text-label-md text-on-surface-variant uppercase">Adresse</p>

                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]">local_shipping</span>
                    </div>
                </div>

                <div class="w-10 h-[2px] bg-primary/20 rounded-full mb-3"></div>

                <h3 class="text-headline-md font-bold text-on-surface">
                    Livraison
                </h3>

                <p class="text-body-sm mt-2 text-on-surface-variant">
                    {{ $order->user->address ?? 'No address provided' }}
                </p>

            </div>

            <!-- ORDER INFO -->
            <div class="glass-card rounded-xl p-5 border border-outline-variant/20 bg-surface-container-lowest h-full">

                <div class="flex justify-between items-start mb-3">
                    <p class="text-label-md text-on-surface-variant uppercase">Commande</p>

                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]">receipt_long</span>
                    </div>
                </div>

                <div class="w-10 h-[2px] bg-primary/20 rounded-full mb-3"></div>

                <p class="text-body-sm">
                    <span class="text-on-surface-variant">ID :</span>
                    <span class="font-medium">{{ $order->id }}</span>
                </p>

                <p class="text-body-sm mt-2">
                    <span class="text-on-surface-variant">Status :</span>
                    <span class="font-medium">{{ ucfirst($order->status) }}</span>
                </p>

                <p class="text-body-sm mt-2">
                    <span class="text-on-surface-variant">Date :</span>
                    <span class="font-medium">{{ $order->created_at->format('d M Y') }}</span>
                </p>

                <p class="text-body-sm mt-2">
                    <span class="text-on-surface-variant">Ref :</span>
                    <span class="font-medium">{{ $order->reference }}</span>
                </p>

            </div>

        </div>

 

    <!-- ITEMS TABLE -->
    <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">

        <!-- HEADER -->
        <div class="px-6 py-5 bg-white/50 border-b border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm">
                Produits commandés
            </h4>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-surface-container-low/50">

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Produit
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Prix unitaire
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-center">
                            Quantité
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-right">
                            Sous-total
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-outline-variant/15">

                    @foreach ($order->items as $item)
                        <tr class="hover:bg-primary/5 transition-colors">

                            <td class="px-6 py-4 font-body-md font-semibold text-on-surface">
                                {{ $item->product_name }}
                            </td>

                            <td class="px-6 py-4 text-on-surface-variant">
                                {{ number_format($item->unit_price, 2, ',', ' ') }} MAD
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-3 py-1 rounded-md bg-surface-container text-on-surface">
                                    {{ $item->quantity }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right font-semibold text-on-surface">
                                {{ number_format($item->subtotal, 2, ',', ' ') }} MAD
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

        <!-- STRONG DIVIDER -->
        <div class="h-px bg-outline-variant/30"></div>

        <!-- TOTAL FOOTER (GREEN HIGHLIGHT) -->
        <div class="p-3 bg-primary/90 text-white font-bold flex justify-end">

            <div class="w-full max-w-xs space-y-2">

                <div class="flex justify-between items-center text-white/90">
                    <span class="uppercase tracking-wider text-sm">Total</span>

                    <span class="text-xl font-extrabold text-white">
                        {{ number_format($order->total_amount, 2, ',', ' ') }} MAD
                    </span>
                </div>

            </div>

        </div>

    </div>
</div>

</x-layouts.admin>