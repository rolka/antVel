<?php
/**
* Documentar
*/
use App\User;
use App\Person;
use App\Business;
use App\UserPoints;
use App\UserAddress;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        #create basic admin user
        $faker=Faker::create();
        Person::create([
            'first_name' => 'Admin',
            'last_name'  => 'root',
            'user'=>[
                'nickname'=>'admin',
                'email'=>'admin@admin.com',
                //'current_points'=>$faker->numberBetween(100000, 500000),
                //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                'role'=>'admin',
                'type'=>'trusted',
                'password'=>\Hash::make('admin'),
                'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@websarrollo',
                'facebook'=>'websarrollo',
                'preferences' => '{"product_viewed":[],"product_purchased":[],"product_shared":[],"product_categories":[],"my_searches":[]}'
            ]
        ]);

        /**
         * Creating users with real emails for test
         * email info:
         * dev: mA9msb78VX
         * seller: ykH0dvY96P
         * buyer: TLlJk0r17w
         */
        #developer (admin)
        $admin=Person::create([
            'first_name' => 'AntVel',
            'last_name'  => 'Developer',
            'user'=>[
                'nickname'=>'dev',
                'email'=>'dev@antvel.com',
                //'current_points'=>$faker->numberBetween(100000, 500000),
                //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                'role'=>'admin',
                'type'=>'trusted',
                'password'=>\Hash::make('123456'),
                'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@websarrollo',
                'facebook'=>'websarrollo',
            ]
        ]);
        #seller
        $company_name = 'antvel seller';
        $seller=Business::create([
            'business_name'=>$company_name,
            'creation_date'=>$faker->date(),
            'local_phone'=>$faker->phoneNumber,
            'user'=>[
                'nickname'=>'antvelseller',
                'email'=>'seller@antvel.com',
                //'current_points'=>$faker->numberBetween(100000, 500000),
                //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                'password'=>Hash::make('123456'),
                'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@seller',
                'facebook'=>$company_name,
            ]
        ])->user;
        #buyer
        $buyer=Person::create([
            'first_name'=>$faker->firstName,
            'last_name'=>$faker->lastName,
            'birthday'=>$faker->dateTimeBetween('-40 years', '-16 years'),
            'sex'=>'male',
            'user'=>[
                'nickname'=>'antvelbuyer',
                'email'=>'buyer@antvel.com',
                //'current_points'=>$faker->numberBetween(100000, 500000),
                //'accumulated_points'=>$faker->numberBetween(500000, 600000),
                'password'=>Hash::make('123456'),
                'pic_url'=>'/img/pt-default/'.$faker->numberBetween(1, 20).'.jpg',
                'twitter'=>'@buyer',
                'facebook'=>'buyer',
                //'current_points'=>100000,
                //'accumulated_points'=>200000,
            ]
        ])->user;

        //marked for deleting
        // UserPoints::create([
        //     'user_id' => $buyer->id,
        //     'action_type_id' => 6,
        //     'source_id' => 1,
        //     'points' => 100000,
        // ]);
        // UserAddress::create([
        //     'user_id'=>$buyer->id,
        //     'default'=>1,
        //     'address'=>[
        //         'line1'=>$faker->streetAddress,
        //         'line2'=>$faker->streetAddress,
        //         'phone'=>$faker->phoneNumber,
        //         'name_contact'=>$faker->streetName,
        //         'zipcode'=>$faker->postcode,
        //         'city'=>$faker->city,
        //         'country'=>$faker->country,
        //         'state'=>$faker->state,
        //     ]
        // ]);
    }
}
