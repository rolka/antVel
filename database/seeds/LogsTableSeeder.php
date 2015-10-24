<?php
/**
* Documentar
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ActionType;
use App\Log;
use App\User;

class LogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        $actions=ActionType::get();
        $users=User::get();
        #Category
        foreach (range(1, 20) as $void) {
            Log::create([
                'user_id'=>$users->random(1)->id,
                'action_type_id'=>$actions->random(1)->id,
                'source_id'=>$faker->numberBetween(50, 1000000),
                'details'=>$faker->text(50)
            ]);
        }
    }
}
