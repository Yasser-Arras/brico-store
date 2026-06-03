<x-layouts.admin>

    <!-- HEADER -->
    <div class="mb-8">
        <div class="p-6 rounded-2xl bg-primary/5 border border-primary/10">
            <h2 class="text-3xl font-bold text-on-surface">Utilisateurs</h2>
            <p class="text-on-surface-variant">
                Gestion des comptes utilisateurs du système.
            </p>
        </div>
    </div>

    <!-- TABLE CARD -->
   <div class="glass-card rounded-xl overflow-hidden border border-outline-variant/20 shadow-sm">

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">

            <!-- HEADER -->
            <thead>
                <tr class="bg-surface-container-low/50">

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Nom
                    </th>

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Email
                    </th>

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Téléphone
                    </th>

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Adresse
                    </th>

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Rôle
                    </th>

                    <th class="px-6 py-4 font-label-md text-outline uppercase tracking-wider">
                        Date
                    </th>

                    <th class="px-6 py-4 text-right font-label-md text-outline uppercase tracking-wider">
                        Actions
                    </th>

                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-outline-variant/10">

                @forelse ($users as $user)
                    <tr class="hover:bg-primary/5 transition-colors">

                        <!-- NAME -->
                        <td class="px-6 py-4 font-semibold text-on-surface">
                            {{ $user->name }}
                        </td>

                        <!-- EMAIL -->
                        <td class="px-6 py-4 text-on-surface-variant">
                            {{ $user->email }}
                        </td>

                        <!-- PHONE -->
                        <td class="px-6 py-4 text-on-surface-variant">
                            {{ $user->phone ?? '—' }}
                        </td>

                        <!-- ADDRESS -->
                        <td class="px-6 py-4 text-on-surface-variant">
                            {{ $user->address ?? '—' }}
                        </td>

                        <!-- ROLE -->
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border
                                {{ $user->role === 'admin'
                                    ? 'bg-primary/10 text-primary border-primary/20'
                                    : 'bg-surface-container text-on-surface-variant border-outline-variant/20' }}">
                                {{ $user->role }}
                            </span>
                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-4 text-on-surface-variant">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-4 text-right">

                            <div class="flex justify-end items-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>

                                <!-- DELETE -->
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Supprimer cet utilisateur ?')"
                                        class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant">
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-[48px] opacity-30">
                                    group
                                </span>
                                <span>Aucun utilisateur trouvé.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>

    <!-- PAGINATION -->
    @if ($users->hasPages())
        <div class="px-6 py-4 border-t border-outline-variant/10">
            {{ $users->links() }}
        </div>
    @endif

</div>

</x-layouts.admin>