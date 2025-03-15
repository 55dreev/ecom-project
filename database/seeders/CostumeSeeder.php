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
            'description' => 'This classic witch costume features a long flowing black robe, a pointed hat, and a mysterious aura that will make you the center of attention at any Halloween or themed event. Complete the look with a broomstick and some eerie makeup for a truly enchanting appearance.'
        ],
        [
            'name' => 'Skeleton Gloves',
            'price' => 800,
            'image' => 'images/glove.jpg',
            'description' => 'These realistic skeleton gloves are the perfect accessory for any spooky costume. Designed with high-quality materials, they offer a comfortable fit and a detailed bone pattern that glows in the dark, making them an excellent choice for haunted houses, Halloween parties, or cosplay events.'
        ],
        [
            'name' => 'Elven Costume',
            'price' => 1000,
            'image' => 'images/elven.png',
            'description' => 'Step into the magical world of fantasy with this beautifully designed elven costume. Featuring a flowing tunic, intricate embroidery, and a lightweight cape, this outfit is perfect for Renaissance fairs, fantasy conventions, or theatrical performances. Pair it with an elegant headpiece or a wooden bow to complete your elven look.'
        ],
        [
            'name' => 'Princess Costume',
            'price' => 2000,
            'image' => 'images/princess.png',
            'description' => 'Feel like royalty in this stunning princess costume. Crafted with shimmering fabric and delicate lace details, this gown is designed for elegance and charm. Whether you’re attending a fairytale-themed party, a cosplay event, or a school play, this outfit will make you shine like a true princess.'
        ],
        [
            'name' => 'Retro Sunglasses',
            'price' => 500,
            'image' => 'images/glasses.png',
            'description' => 'Add a touch of vintage flair to your outfit with these stylish retro sunglasses. Featuring a bold, oversized frame and UV-protective lenses, these sunglasses are perfect for completing your classic 80s or 90s look. Whether you’re dressing up for a themed event or just looking for a cool accessory, these shades have you covered.'
        ],
        [
            'name' => 'Zombie Kit',
            'price' => 400,
            'image' => 'images/makeup.png',
            'description' => 'Transform yourself into a terrifying undead creature with this complete zombie makeup kit. It includes realistic-looking fake blood, dark under-eye makeup, latex scars, and a step-by-step guide to achieve a truly horrifying zombie effect. Ideal for Halloween, cosplay, or any horror-themed event.'
        ],
    ];

    foreach ($costumes as $costume) {
        Costume::updateOrCreate(
            ['name' => $costume['name']],
            $costume
        );
    }
}

}
