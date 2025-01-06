<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'firstName' => 'mohnd',
                'lastName' => 'ibrahem',
                'phoneNumber' => '0997393611',
                'password' => bcrypt('123123123'),
                'location' => 'damascus,baghdad-street',
                'number_verification' => now(),
            ],
            [
                'firstName' => 'munther',
                'lastName' => 'alsaraj',
                'phoneNumber' => '0949196001',
                'password' => bcrypt('123123123'),
                'location' => 'Los Angeles',
                'number_verification' => now(),
            ],
            [
                'firstName' => 'mouaz',
                'lastName' => 'ajaj',
                'phoneNumber' => '0930796963',
                'password' => bcrypt('123123123'),
                'location' => 'Dubai',
                'number_verification' => now(),
            ],
            [
                'firstName' => 'Sara',
                'lastName' => 'fadi',
                'phoneNumber' => '0985991391',
                'password' => bcrypt('123123123'),
                'location' => 'Dubai',
                'number_verification' => now(),
            ],
            [
                'firstName' => 'zeina',
                'lastName' => 'khlil',
                'phoneNumber' => '0982777591',
                'password' => bcrypt('123123123'),
                'location' => 'Dubai',
                'number_verification' => now(),
            ],[
                'firstName' => 'maher',
                'lastName' => 'ibrahem',
                'phoneNumber' => '0931824199',
                'password' => bcrypt('123123123'),
                'location' => 'Dubai',
                'number_verification' => now(),
            ],
        ];

        foreach ($data as $user) {
        User::create($user);
        }
    }
}
