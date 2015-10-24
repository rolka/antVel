<?php
/**
* Documentar
*/
use App\Address as Address;
use App\User as User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        #Category
        for ($i=0;$i<10; $i++) {
            $user = User::select(['id'])->orderByRaw('RAND()')->first();

            $address=Address::create([
                'user_id' => ($i <= 2) ? 4 : $user->id,
                'default'=>0,
                'line1' => $faker->streetAddress,
                'line2' => $faker->streetAddress,
                'phone' => $faker->phoneNumber,
                'name_contact' => $faker->streetName,
                'zipcode' => $faker->postcode,
                'city' => $faker->city,
                'country' => $faker->country,
                'state' => $faker->state
            ]);
        }
    }
}
