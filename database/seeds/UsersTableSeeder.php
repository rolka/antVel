<?php
/**
* Documentar
*/
use App\User as User;
use App\Person as Person;
use App\Business as Business;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        #create some users for every role
        for ($i=0; $i < 10; $i++) {
            #persons
            Person::create([
                'first_name'=>$faker->firstName,
                'last_name'=>$faker->lastName,
                'birthday'=>$faker->dateTimeBetween('-40 years', '-16 years'),
                'sex'=>$faker->randomElement(['male', 'female']),
                'user'=>[
                    'nickname'=>$faker->userName,
                    'email'=>$faker->unique()->email,
                    //'current_points'=>$faker->numberBetween(100000, 500000),
                    //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                    'role'=>'person',
                    'password'=>\Hash::make('123456'),
                    'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                    'twitter'=>'@'.$faker->userName,
                    'facebook'=>$faker->userName,
                    'preferences' => '{"product_viewed":[],"product_purchased":[],"product_shared":[],"product_categories":[],"my_searches":[]}'
                ]
            ]);
        }
        for ($i=0;$i<8;$i++) {
            $company_name = $faker->company;
            #business
            Business::create([
                'business_name'=>$company_name,
                'creation_date'=>$faker->date(),
                'local_phone'=>$faker->phoneNumber,
                'user'=>[
                    'nickname'=>$faker->userName,
                    'email'=>$faker->unique()->email,
                    //'current_points'=>$faker->numberBetween(100000, 500000),
                    //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                    'role'=>$faker->randomElement(['business']), //, 'nonprofit'
                    'type'=>$faker->randomElement(['normal', 'trusted']),
                    'password'=>\Hash::make('123456'),
                    'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                    'twitter'=>'@'.$company_name,
                    'facebook'=>$company_name,
                    'preferences' => '{"product_viewed":[],"product_purchased":[],"product_shared":[],"product_categories":[],"my_searches":[]}'
                ]
            ]);
        }
    }
}
