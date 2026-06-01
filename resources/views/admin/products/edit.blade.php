<x-layouts.admin heading="Modifier le produit">
    <form class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['button' => 'Enregistrer'])
    </form>
</x-layouts.admin>
