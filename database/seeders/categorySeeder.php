<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['name'=>'Restaurant'],
            ['name'=>'Electronic'],
            ['name'=>'Pharmacy'],
            ['name'=>'Super market'],
            ['name'=>'Perfumes'],
        ];
        foreach($data as $category){
            category::create($category);
        }

    }
}
