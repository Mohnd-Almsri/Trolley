<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$data = [
    ['user_id'=>1,
        'store_id'=>1,
        'role'=>'Super-Admin',],
    ['user_id'=>2,
        'store_id'=>2,
        'role'=>'Admin',],
    ['user_id'=>3,
        'store_id'=>3,
        'role'=>'Admin',],
    ['user_id'=>4,
        'store_id'=>4,
        'role'=>'Admin',],
    ['user_id'=>5,
        'store_id'=>5,
        'role'=>'Admin',],
    ];
foreach($data as $admin){
    Admin::create($admin);
}
    }
}
