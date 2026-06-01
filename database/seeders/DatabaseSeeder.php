<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bricomag.test'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
            ]
        );

        $categories = collect([
            ['name' => 'Outillage', 'description' => 'Outils manuels et electriques pour les chantiers.'],
            ['name' => 'Peinture', 'description' => 'Peintures, rouleaux et accessoires de finition.'],
            ['name' => 'Jardinage', 'description' => 'Materiel pour entretenir et amenager les espaces verts.'],
            ['name' => 'Quincaillerie', 'description' => 'Visserie, fixations, serrures et consommables.'],
        ])->map(fn ($category) => Category::updateOrCreate(['name' => $category['name']], $category));

        $products = [
            [
                'category' => 'Outillage',
                'name' => 'Perceuse visseuse sans fil 18V',
                'description' => 'Perceuse compacte avec deux batteries, mandrin auto-serrant et eclairage LED pour les travaux precis.',
                'price' => 899,
                'stock_quantity' => 18,
                'image_path' => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category' => 'Peinture',
                'name' => 'Peinture murale blanche 10L',
                'description' => 'Peinture mate couvrante pour murs interieurs, ideale pour salons, chambres et bureaux.',
                'price' => 329,
                'stock_quantity' => 42,
                'image_path' => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category' => 'Jardinage',
                'name' => 'Tuyau arrosage renforce 25m',
                'description' => 'Tuyau souple anti-torsion avec raccords rapides pour arrosage regulier du jardin.',
                'price' => 189,
                'stock_quantity' => 31,
                'image_path' => 'https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category' => 'Quincaillerie',
                'name' => 'Coffret visserie multi-usages',
                'description' => 'Assortiment de vis, chevilles et embouts pour fixation sur bois, platre et beton.',
                'price' => 119,
                'stock_quantity' => 64,
                'image_path' => 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category' => 'Outillage',
                'name' => 'Marteau menuisier manche fibre',
                'description' => 'Marteau robuste avec manche antiderapant et tete acier pour assemblage et demontage.',
                'price' => 79,
                'stock_quantity' => 27,
                'image_path' => 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category' => 'Peinture',
                'name' => 'Kit rouleaux et pinceaux',
                'description' => 'Kit complet avec bac, rouleaux et pinceaux pour appliquer peintures et vernis proprement.',
                'price' => 95,
                'stock_quantity' => 38,
                'image_path' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($products as $product) {
            $category = $categories->firstWhere('name', $product['category']);
            unset($product['category']);

            Product::updateOrCreate(
                ['name' => $product['name']],
                ['category_id' => $category->id, ...$product]
            );
        }
    }
}
