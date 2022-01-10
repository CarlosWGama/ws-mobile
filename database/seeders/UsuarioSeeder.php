<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Usuario::create([
            'nome'  => 'Admin',
            'email' => 'admin@teste.com',
            'senha' => bcrypt('123456'),
            'admin' => true
        ]);
    }
}
