<x-layouts.admin heading="Ajouter une categorie">
    <form class="max-w-3xl rounded-lg border border-zinc-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('admin.categories.store') }}">
        @include('admin.categories._form', ['button' => 'Ajouter la categorie'])
    </form>
</x-layouts.admin>
