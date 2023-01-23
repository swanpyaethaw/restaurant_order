<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            $roles = ['admin','chef','cashier','waiter'];
            foreach($roles as $key=>$value){
                DB::table('roles')->insert([
                    'name' => $roles[$key]
                ]);
            }

            DB::table('categories')->insert([
                'name' => 'Uncategorized',
                'description' => 'Uncategorized',
            ]);



    }
}
