<x-layouts.admin heading="Modifier la categorie">
    <form class="max-w-3xl rounded-lg border border-zinc-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('admin.categories.update', $category) }}">
        @method('PUT')
        @include('admin.categories._form', ['button' => 'Enregistrer'])
    </form>
</x-layouts.admin>
