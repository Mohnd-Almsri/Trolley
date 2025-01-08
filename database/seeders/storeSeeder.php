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
                'image'=>'Stores/Restaurant/Pizza_Palace/Pizza_Palace.jpg'
            ],
            [
                'name' => 'Tech World',
                'description' => 'Latest gadgets and electronics',
                'category_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Tech_World.png'

            ],
            [
                'name' => 'Health Plus',
                'description' => 'Your trusted pharmacy',
                'category_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Health_Plus.png'
            ],
            [
                'name' => 'Daily Fresh',
                'description' => 'Fresh groceries every day',
                'category_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Daily_Fresh.jpg'

            ],
            [
                'name' => 'Luxury Scents',
                'description' => 'Exclusive perfumes and fragrances',
                'category_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Luxury_Scents.png'

            ], [
                'name' => 'KFC',
                'description' => 'Best pizza in town',
                'category_id' => 1,
                'image'=>'Stores/Restaurant/KFC/KFC.png'

            ],
            [
                'name' => 'Pulpo tech',
                'description' => 'Latest gadgets and electronics',
                'category_id' => 2,
                'image'=>'Stores/Electronic/Pulpo_tech/Pulpo_tech.jpg'

            ],
            [
                'name' => 'CVS Health',
                'description' => 'Your trusted pharmacy',
                'category_id' => 3,
                'image'=>'Stores/Pharmacy/CVS_Health/CVS_Health.png'
            ],
            [
                'name' => 'walmart',
                'description' => 'Fresh groceries every day',
                'category_id' => 4,
                'image'=>'Stores/Super_market/walmart/walmart.png'
            ],
            [
                'name' => 'Sephora',
                'description' => 'Exclusive perfumes and fragrances',
                'category_id' => 5,
                'image'=>'Stores/Perfumes/Sephora/Sephora.png'
            ],
        ];
        foreach ($stores as $store) {

            Store::create($store);
        }

    }
}
