<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class storeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Pizza Palace',
                'description' => 'Best pizza in town',
                'category_id' => 1,
            ],
            [
                'name' => 'Tech World',
                'description' => 'Latest gadgets and electronics',
                'category_id' => 2,
            ],
            [
                'name' => 'Health Plus',
                'description' => 'Your trusted pharmacy',
                'category_id' => 3,
            ],
            [
                'name' => 'Daily Fresh',
                'description' => 'Fresh groceries every day',
                'category_id' => 4,
            ],
            [
                'name' => 'Luxury Scents',
                'description' => 'Exclusive perfumes and fragrances',
                'category_id' => 5,
            ],
        ];
        foreach ($stores as $store) {

            Store::create($store);
        }

    }
}
