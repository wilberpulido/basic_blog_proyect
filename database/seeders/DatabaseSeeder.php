<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Uso create para saber los valores para iniciar sesion luego
        \App\Models\User::create([
            'name'=> 'Wilber Pulido',
            'email'=> 'pulidowilber@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        \App\Models\User::create([
            'name'=> 'Daniel Marquina',
            'email'=> 'marquinadaniel@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        \App\Models\Post::factory(24)->create();

    }
}
