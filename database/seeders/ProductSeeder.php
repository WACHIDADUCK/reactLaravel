<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $usuario1 = User::create([
            'name' => 'usuario1',
            'email' => "email1@gmail.com",
            'password' => bcrypt("1234")
        ]);
        $usuario1->save();
        Product::factory(3)->create(['user_id' => $usuario1->id]);


        $usuario2 = User::create([
            'name' => 'usuario2',
            'email' => "email2@gmail.com",
            'password' => bcrypt("1234")
        ]);
        $usuario2->save();
        Product::factory(3)->create(['user_id' => $usuario2->id]);


        // $usuario2 = User::create();
        // $usuario2->name = "usuario2";
        // $usuario2->email = "email2@gmail.com";
        // $usuario2->password = bcrypt("11234");
        // $usuario2->save();
        // Product::factory(3)->create(['user_id' => $usuario1->id]);


        // $usuarios = User::factory(3)->create();
        // foreach ($usuarios as $usuario) {
        //     Product::factory(3)->create(['user_id' => $usuario->id]);
        // }


        // Product::factory(50)->create();
    }
}
