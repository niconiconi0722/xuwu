<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $users = factory(User::class)
                        ->times(10)
                        ->make();

        $user_array = $users->makeVisible(['password'])->toArray();

        User::insert($user_array);
    }
}
