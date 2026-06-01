<x-layouts.admin heading="Ajouter un produit">
    <form class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @include('admin.products._form', ['button' => 'Ajouter le produit'])
    </form>
</x-layouts.admin>
