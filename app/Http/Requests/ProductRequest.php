<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:160', Rule::unique('products', 'name')->ignore($product)],
            'description' => ['required', 'string', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du produit est obligatoire.',
            'name.unique' => 'Un produit avec ce nom existe deja.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caracteres.',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit etre un nombre valide.',
            'stock_quantity.required' => 'La quantite en stock est obligatoire.',
            'stock_quantity.integer' => 'La quantite doit etre un nombre entier.',
            'category_id.required' => 'La categorie est obligatoire.',
            'category_id.exists' => 'La categorie selectionnee est invalide.',
            'image.required' => 'L image du produit est obligatoire.',
            'image.image' => 'Le fichier doit etre une image.',
            'image.mimes' => 'Les formats acceptes sont jpg, jpeg, png et webp.',
            'image.max' => 'L image ne doit pas depasser 2 Mo.',
        ];
    }
}
