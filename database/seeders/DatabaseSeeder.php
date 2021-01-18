<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@me.com',
            'description' => 'This is the Admin account!',
            'password' => Hash::make('password'),
            'type' => 'Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        User::factory()
        ->times(50)
        ->create();
    }
}
