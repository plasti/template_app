<?php

use Illuminate\Database\Seeder;

class CrearUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "Plastimedia",
            "email" => "desarrollo@plastimedia.com",
            "password" => bcrypt("plasti249"),
            "estado" => "Si",
            "rol" => "Administrador",
        ]);
        DB::table("users")->insert([
            "name" => "Soporte",
            "email" => "soporte@plastimedia.com",
            "password" => bcrypt("plasti249"),
            "estado" => "Si",
            "rol" => "Administrador",
        ]);
    }
}