<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();
        $itemFiles = [
            'public/data/appetizers.php',
            'public/data/beverages.php',
            'public/data/burgers.php',
            'public/data/desserts.php',
            'public/data/pasta.php',
            'public/data/ribs&steak.php'
        ];
        foreach($itemFiles as $itemFile){
            $items = include($itemFile);
            foreach($items as $item){
                Item::create($item);
            }
        }
    }
}
