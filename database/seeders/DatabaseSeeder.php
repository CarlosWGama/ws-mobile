<?php

use Database\Seeders\TarefaSeeder;
use Database\Seeders\UsuarioSeeder;
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
        $this->call(UsuarioSeeder::class);
        $this->call(TarefaSeeder::class);
    }
}
