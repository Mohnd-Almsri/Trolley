<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Cheeseburger Combo',
                'description' => 'Juicy cheeseburger served with fries and a soda.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 1,
                'image'=>'Stores/Restaurant/Pizza_Palace/Products/Cheeseburger_Combo.jpg'
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Classic Italian pizza with tomato sauce, mozzarella, and basil.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 1,
                'image'=>'Stores/Restaurant/Pizza_Palace/Products/Margherita_Pizza.jpg'
            ],
            [
                'name' => 'Chicken Alfredo Pasta',
                'description' => 'Creamy fettuccine pasta with grilled chicken and parmesan.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 1,
                'image'=>'Stores/Restaurant/Pizza_Palace/Products/Chicken_Alfredo_Pasta.jpg'

            ],

            [
                'name' => 'Grilled Steak',
                'description' => 'Tender grilled steak served with mashed potatoes and steamed vegetables.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 1,
                'image'=>'Stores/Restaurant/Pizza_Palace/Products/Grilled_Steak.jpg'
            ],
            [
                'name' => 'Chicken Shawarma Wrap',
                'description' => 'Grilled chicken, garlic sauce, and pickles wrapped in pita bread.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 1,
                'image'=>'Stores/Restaurant/Pizza_Palace/Products/Chicken_Shawarma_Wrap.jpg'

            ],
            [
                'name' => 'Beef Kebab Plate',
                'description' => 'Grilled beef kebabs served with rice and a side of salad.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 6,
                'image'=>'Stores/Restaurant/KFC/Products/Beef_Kebab_Plate.jpg'
            ],
            [
                'name' => 'Fish and Chips',
                'description' => 'Golden-fried fish fillets served with crispy fries and tartar sauce.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 6,
                'image'=>'Stores/Restaurant/KFC/Products/Fish_and_Chips.jpg'
            ],
            [
                'name' => 'Buffalo Wings',
                'description' => 'Spicy buffalo wings served with blue cheese dressing.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 6,
                'image'=>'Stores/Restaurant/KFC/Products/Buffalo_Wings.jpg'
            ],
            [
                'name' => 'Veggie Burger',
                'description' => 'Plant-based burger patty with lettuce, tomato, and vegan mayo.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 6,
                'image'=>'Stores/Restaurant/KFC/Products/Veggie_Burger.jpg'
            ],
            [
                'name' => 'Seafood Paella',
                'description' => 'Spanish rice dish with shrimp, mussels, and calamari.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 6,
                'image'=>'Stores/Restaurant/KFC/Products/Seafood_Paella.jpg'
            ],

            [
                'name' => 'Smartphone',
                'description' => 'Latest model with advanced features and 128GB storage.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Products/Smartphone.jpg'
            ],
            [
                'name' => 'Laptop',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Products/Laptop.jpg'
            ],
            [
                'name' => 'Bluetooth Headphones',
                'description' => 'Noise-cancelling wireless headphones with 20 hours of battery life.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Products/Bluetooth_Headphones.jpg'

            ],
            [
                'name' => 'Smart TV',
                'description' => '4K Ultra HD Smart TV with built-in streaming apps.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Products/Smart_TV.jpg'

            ],
            [
                'name' => 'Gaming Console',
                'description' => 'Next-generation gaming console with 4K gaming support.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 2,
                'image'=>'Stores/Electronic/Tech_World/Products/Gaming_Console.jpg'

            ],
            [
                'name' => 'Tablet',
                'description' => 'Lightweight tablet with 10-inch screen and 64GB storage.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 7,
                'image'=>'Stores/Electronic/Pulpo_tech/Products/Tablet.jpg'

            ],
            [
                'name' => 'Smartwatch',
                'description' => 'Stylish smartwatch with health tracking and notifications.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 7,
                'image'=>'Stores/Electronic/Pulpo_tech/Products/Smartwatch.jpg'

            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'Compact wireless earbuds with touch controls and charging case.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 7,
                'image'=>'Stores/Electronic/Pulpo_tech/Products/Wireless_Earbuds.jpg'

            ],
            [
                'name' => 'External Hard Drive',
                'description' => '1TB external hard drive for secure data storage.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 7,
                'image'=>'Stores/Electronic/Pulpo_tech/Products/External_Hard_Drive.jpg'

            ],
            [
                'name' => 'Mechanical Keyboard',
                'description' => 'RGB backlit mechanical keyboard for gaming and productivity.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 7,
                'image'=>'Stores/Electronic/Pulpo_tech/Products/Mechanical_Keyboard.jpg'

            ],
            [
                'name' => 'Pain Relief Tablets',
                'description' => 'Effective tablets for headache and minor aches.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Products/Pain_Relief_Tablets.jpg'
            ],
            [
                'name' => 'Cough Syrup',
                'description' => 'Soothing syrup for dry and wet cough.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Products/Cough_Syrup.jpg'

            ],
            [
                'name' => 'Vitamin C Tablets',
                'description' => 'Boosts immunity and reduces fatigue.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Products/Vitamin_C_Tablets.jpg'

            ],
            [
                'name' => 'Hand Sanitizer',
                'description' => 'Kills 99.9% of germs. Alcohol-based formula.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Products/Hand_Sanitizer.jpg'

            ],
            [
                'name' => 'Face Masks',
                'description' => 'Pack of 50 disposable 3-ply face masks.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 3,
                'image'=>'Stores/Pharmacy/Health_Plus/Products/Face_Masks.jpg'

            ],
            [
                'name' => 'Digital Thermometer',
                'description' => 'Accurate temperature readings in seconds.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 8,
                'image'=>'Stores/Pharmacy/CVS_Health/Products/Digital_Thermometer.jpg'

            ],
            [
                'name' => 'First Aid Kit',
                'description' => 'Complete kit with bandages, antiseptics, and tools.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 8,
                'image'=>'Stores/Pharmacy/CVS_Health/Products/First_Aid_Kit.jpg'

            ],
            [
                'name' => 'Blood Pressure Monitor',
                'description' => 'Easy-to-use device for monitoring blood pressure.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 8,
                'image'=>'Stores/Pharmacy/CVS_Health/Products/Blood_Pressure_Monitor.jpg'

            ],
            [
                'name' => 'Antihistamine Tablets',
                'description' => 'Relieves symptoms of allergies and hay fever.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 8,
                'image'=>'Stores/Pharmacy/CVS_Health/Products/Antihistamine_Tablets.jpg'

            ],
            [
                'name' => 'Muscle Pain Gel',
                'description' => 'Fast relief for muscle and joint pain.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 8,
                'image'=>'Stores/Pharmacy/CVS_Health/Products/Muscle_Pain_Gel.jpg'

            ],
            [
                'name' => 'Fresh Milk',
                'description' => '1-liter pack of fresh and pure cow milk.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Products/Fresh_Milk.jpg'

            ],
            [
                'name' => 'White Bread',
                'description' => 'Freshly baked sliced bread, perfect for sandwiches.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Products/White_Bread.jpg'

            ],
            [
                'name' => 'Eggs Pack',
                'description' => '12-pack of farm-fresh eggs.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Products/Eggs_Pack.jpg'

            ],
            [
                'name' => 'Butter',
                'description' => '200g of creamy and unsalted butter.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Products/Butter.jpg'

            ],
            [
                'name' => 'Cheddar Cheese',
                'description' => '500g block of sharp cheddar cheese.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 4,
                'image'=>'Stores/Super_market/Daily_Fresh/Products/Cheddar_Cheese.jpg'

            ],
            [
                'name' => 'Chicken Breast',
                'description' => '1kg of fresh boneless chicken breast.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 9,
                'image'=>'Stores/Super_market/walmart/Products/Chicken_Breast.jpg'

            ],
            [
                'name' => 'Rice (5kg)',
                'description' => 'Long-grain basmati rice, perfect for cooking.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 9,
                'image'=>'Stores/Super_market/walmart/Products/Rice_(5kg).jpg'

            ],
            [
                'name' => 'Cooking Oil',
                'description' => '2-liter bottle of sunflower cooking oil.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 9,
                'image'=>'Stores/Super_market/walmart/Products/Cooking_Oil.jpg'

            ],
            [
                'name' => 'Pasta',
                'description' => '500g pack of premium Italian spaghetti.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 9,
                'image'=>'Stores/Super_market/walmart/Products/Pasta.jpg'

            ],
            [
                'name' => 'Tomato Ketchup',
                'description' => '1-liter bottle of rich and tangy tomato ketchup.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 9,
                'image'=>'Stores/Super_market/walmart/Products/Tomato_Ketchup.jpg'

            ],
            [
                'name' => 'Rose Essence Perfume',
                'description' => 'A luxurious perfume with a fresh rose fragrance.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Products/Rose_Essence_Perfume.jpg'

            ],
            [
                'name' => 'Oud Al Arab',
                'description' => 'An exotic oud-based perfume with long-lasting aroma.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Products/Oud_Al_Arab.jpg'

            ],
            [
                'name' => 'Vanilla Bliss',
                'description' => 'A sweet and comforting vanilla-scented perfume.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Products/Vanilla_Bliss.jpg'

            ],
            [
                'name' => 'Citrus Splash',
                'description' => 'A refreshing perfume with notes of citrus and bergamot.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Products/Citrus_Splash.jpg'

            ],
            [
                'name' => 'Lavender Mist',
                'description' => 'A calming lavender fragrance, perfect for everyday use.',
                'price' => rand(50, 1000),
                'quantity' => rand(1, 50),
                'store_id' => 5,
                'image'=>'Stores/Perfumes/Luxury_Scents/Products/Lavender_Mist.jpg'

            ],
            [
                'name' => 'Jasmine Bloom',
                'description' => 'A rich and enchanting jasmine-scented perfume.',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 100),
                'store_id' => 10,
                'image'=>'Stores/Perfumes/Sephora/Products/Jasmine_Bloom.jpg'

            ],
            [
                'name' => 'Woody Musk',
                'description' => 'A masculine perfume with woody and musky notes.',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 100),
                'store_id' => 10,
                'image'=>'Stores/Perfumes/Sephora/Products/Woody_Musk.jpg'

            ],
            [
                'name' => 'Amber Glow',
                'description' => 'A warm and captivating amber-based fragrance.',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 100),
                'store_id' => 10,
                'image'=>'Stores/Perfumes/Sephora/Products/Amber_Glow.jpg'

            ],
            [
                'name' => 'Patchouli Dream',
                'description' => 'A bold and earthy patchouli perfume for unique individuals.',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 100),
                'store_id' => 10,
                'image'=>'Stores/Perfumes/Sephora/Products/Patchouli_Dream.jpg'

            ],
            [
                'name' => 'Mint Breeze',
                'description' => 'A cooling and invigorating mint-scented fragrance.',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 100),
                'store_id' => 10,
                'image'=>'Stores/Perfumes/Sephora/Products/Mint_Breeze.jpg'

            ]
        ];
        foreach ($data as $product){
            Product::create($product);

        }

    }}
