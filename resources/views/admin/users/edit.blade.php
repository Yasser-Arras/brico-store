<x-layouts.admin heading="Modifier l'utilisateur">

    <form
        class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm"
        method="POST"
        action="{{ route('admin.users.update', $user) }}"
    >
        @csrf
        @method('PUT')

        @include('admin.users._form', ['button' => 'Enregistrer'])

    </form>

</x-layouts.admin>