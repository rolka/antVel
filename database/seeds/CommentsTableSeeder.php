<?php
/**
* Documentar
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ActionType;
use App\Comment;
use App\User;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create();
        $actions=ActionType::get();
        $users=User::get();
        #Category
        foreach (range(1, 20) as $void) {
            Comment::create([
                'user_id'=>$users->random(1)->id,
                'action_type_id'=>$actions->random(1)->id,
                'source_id'=>$faker->numberBetween(50, 1000000),
                'comment'=>$faker->text(50)
            ]);
        }
    }
}
