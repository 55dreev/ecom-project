<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Costume;

class CostumeSeeder extends Seeder
{
    public function run()
    {
        $costumes = [
            [
                'name' => 'Classic Witch Costume',
                'price' => 4000,
                'image' => 'images/gown.svg',
            ],
            [
                'name' => 'Skeleton Gloves',
                'price' => 800,
                'image' => 'images/glove.jpg',
            ],
            [
                'name' => 'Elven Costume',
                'price' => 1000,
                'image' => 'images/elven.png',
            ],
            [
                'name' => 'Princess Costume',
                'price' => 2000,
                'image' => 'images/princess.png',
            ],
            [
                'name' => 'Retro Sunglasses',
                'price' => 500,
                'image' => 'images/glasses.png',
            ],
            [
                'name' => 'Zombie Kit',
                'price' => 400,
                'image' => 'images/makeup.png',
            ],
            // Add more costumes if needed
        ];

        foreach ($costumes as $costume) {
            Costume::updateOrCreate(
                ['name' => $costume['name']], // Check if this name already exists
                $costume // Update or insert the record
            );
        }
    }
}
