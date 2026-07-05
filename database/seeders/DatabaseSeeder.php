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
            [   'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0123456789',
                'address' => '123 Rue de l\'Admin, 75000 Maroc',
                ]);
        $categories = collect([
            ['name' => 'Outillage', 'description' => 'Outils manuels et electriques pour les chantiers.'],
            ['name' => 'Peinture', 'description' => 'Peintures, rouleaux et accessoires de finition.'],
            ['name' => 'Jardinage', 'description' => 'Materiel pour entretenir et amenager les espaces verts.'],
            ['name' => 'Quincaillerie', 'description' => 'Visserie, fixations, serrures et consommables.'],
        ])->map(fn($category) => Category::updateOrCreate(['name' => $category['name']], $category));

        $products = [
                        [   'category' => 'Outillage',
                            'name' => 'Perceuse à percussion 850W',
                            'description' => 'Perceuse puissante adaptée au béton, au bois et au métal.',
                            'price' => 649,
                            'stock_quantity' => 12,
                            'image_path' => 'products/perceuse.png',
                        ],
                        
                        [
                            'category' => 'Outillage',
                            'name' => 'Meuleuse d\'angle 125mm',
                            'description' => 'Outil idéal pour la découpe et le ponçage de différents matériaux.',
                            'price' => 499,
                            'stock_quantity' => 15,
                            'image_path' => 'products/meuleuse.png',
                        ],
                        [
                            'category' => 'Outillage',
                            'name' => 'Marteau de charpentier',
                            'description' => 'Marteau robuste avec manche ergonomique antidérapant.',
                            'price' => 79,
                            'stock_quantity' => 40,
                            'image_path' => 'products/marteau.png',
                        ],

                        [
                            'category' => 'Peinture',
                            'name' => 'Peinture Acrylique Blanche 10L',
                            'description' => 'Peinture intérieure mate à fort pouvoir couvrant.',
                            'price' => 299,
                            'stock_quantity' => 30,
                            'image_path' => 'products/peinture-blanche.png',
                        ],
                        [
                            'category' => 'Peinture',
                            'name' => 'Rouleau Professionnel',
                            'description' => 'Rouleau adapté aux murs et plafonds.',
                            'price' => 35,
                            'stock_quantity' => 70,
                            'image_path' => 'products/rouleau.png',
                        ],
                        [
                            'category' => 'Peinture',
                            'name' => 'Pinceau Plat 50mm',
                            'description' => 'Pinceau de qualité pour peinture et vernis.',
                            'price' => 18,
                            'stock_quantity' => 90,
                            'image_path' => 'products/pinceau.png',
                        ],

                        [
                            'category' => 'Jardinage',
                            'name' => 'Tuyau d\'arrosage 25m',
                            'description' => 'Tuyau renforcé avec raccords rapides.',
                            'price' => 179,
                            'stock_quantity' => 22,
                            'image_path' => 'products/tuyau.png',
                        ],
                        [
                            'category' => 'Jardinage',
                            'name' => 'Pelle de jardin',
                            'description' => 'Pelle résistante pour travaux de jardinage.',
                            'price' => 89,
                            'stock_quantity' => 18,
                            'image_path' => 'products/pelle.png',
                        ],
                        [
                            'category' => 'Jardinage',
                            'name' => 'Sécateur Professionnel',
                            'description' => 'Sécateur en acier pour la taille des plantes.',
                            'price' => 59,
                            'stock_quantity' => 35,
                            'image_path' => 'products/secateur.png',
                        ],

                        [
                            'category' => 'Quincaillerie',
                            'name' => 'Boîte de Vis 500 pièces',
                            'description' => 'Assortiment de vis pour différents usages.',
                            'price' => 65,
                            'stock_quantity' => 80,
                            'image_path' => 'products/vis.png',
                        ],
                        [
                            'category' => 'Quincaillerie',
                            'name' => 'Chevilles Nylon 100 pièces',
                            'description' => 'Chevilles de fixation pour murs et cloisons.',
                            'price' => 25,
                            'stock_quantity' => 120,
                            'image_path' => 'products/chevilles.png',
                        ],
                        [
                            'category' => 'Quincaillerie',
                            'name' => 'Serrure de porte',
                            'description' => 'Serrure complète avec clés de sécurité.',
                            'price' => 145,
                            'stock_quantity' => 16,
                            'image_path' => 'products/serrure.png',
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
