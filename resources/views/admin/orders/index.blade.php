<x-layouts.admin>

    <!-- Header -->
    <div class="mb-8">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 p-6 rounded-2xl bg-primary/5 border border-primary/10">

            <div class="space-y-2">
                <h2 class="text-3xl font-bold text-on-surface tracking-tight">
                    Commandes
                </h2>

                <p class="text-base text-on-surface-variant">
                    Liste des commandes du système
                </p>
            </div>

        </div>
    </div>

    <!-- Table Card -->
    <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">

        <!-- Title -->
        <div class="px-6 py-5 bg-white/50 border-b border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm">
                Toutes les commandes
            </h4>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Référence
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Client
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Statut
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Total
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                            Date
                        </th>

                        <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider text-right">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-outline-variant/10">

                    @forelse ($orders as $order)
                                    <tr class="hover:bg-primary/5 transition-colors group">

                                        <td class="px-6 py-4 font-body-md font-bold text-on-surface">
                                            {{ $order->reference }}
                                        </td>

                                        <td class="px-6 py-4 text-body-md text-on-surface">
                                            {{ $order->user->name ?? 'Deleted user' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if($order->status === 'done')
                            bg-primary/10 text-primary border border-primary/20
                        @elseif($order->status === 'processing')
                            bg-yellow-100 text-yellow-700 border border-yellow-300
                        @else
                            bg-surface-container text-on-surface-variant
                        @endif
                        ">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-on-surface">
                                            {{ number_format($order->total_amount, 2, ',', ' ') }} MAD
                                        </td>

                                        <td class="px-6 py-4 text-sm text-on-surface-variant">
                                            {{ $order->created_at->format('Y-m-d H:i') }}
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="text-primary font-label-md  inline-flex items-center gap-1 leading-none">

                                                <span>Voir</span>

                                                <span class="material-symbols-outlined text-sm leading-none flex items-center">
                                                    arrow_forward
                                                </span>

                                            </a>
                                        </td>

                                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">
                                        receipt_long
                                    </span>
                                    <span>Aucune commande trouvée.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>

</x-layouts.admin>