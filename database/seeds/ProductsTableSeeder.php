<?php
/**
* Documentar
*/
use App\Product as Product;
use App\ProductOffer as ProductOffer;
use App\Business as Business;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        $businesses=Business::get();
        $numCategories = DB::table('categories')->count();
        for ($i=0;$i<150;$i++) {
            $price=$faker->numberBetween(1, 99);
            $stock=$faker->numberBetween(20, 50);
            $id=Product::create([
                'category_id'=>$faker->numberBetween(1, $numCategories),
                'user_id'=>'3', //$businesses->random(1)->user_id
                'name'=>$faker->unique()->catchPhrase,
                'description'=>$faker->text(500),
                'price'=>$price, //*1000,
                'stock'=>$stock,
                'brand'=>$faker->randomElement(['Apple', 'Gigabyte', 'Microsoft', 'Google. Inc', 'Samsung', 'Lg']),
                'features'=>json_encode([
                    "images"=>[
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg',
                    '/img/pt-default/'.$faker->numberBetween(1, 330).'.jpg'
                    ],
                    "weight"=>$faker->numberBetween(10, 150).' '.$faker->randomElement(["Mg", "Gr", "Kg", "Oz", "Lb"]),
                    "dimensions"=>$faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' X '.
                                  $faker->numberBetween(1, 30).' '.
                                  $faker->randomElement(["inch", "mm", "cm"]),
                    "color"=>$faker->safeColorName
                ]),
                'condition'=>$faker->randomElement(['new', 'refurbished', 'used']),
                'low_stock'=>$faker->randomElement([5, 10, 15]),
                'tags' => $faker->word.','.$faker->word.','.$faker->word
            ]);
            if ($faker->numberBetween(0, 1)) {
                $percentage=$faker->randomElement([10, 15, 25, 35, 50]);
                ProductOffer::create([
                    'product_id'=>$id->id,
                    'day_start'=>$faker->dateTime(),
                    'day_end'=>$faker->dateTimeBetween('now', '+1 years'),
                    'percentage'=>$percentage,
                    'price'=>(($percentage*$price)/100),
                    'quantity'=>round($stock/2)
                ]);
            }
        }
    }
}
