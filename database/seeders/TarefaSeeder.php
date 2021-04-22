<?php

namespace Database\Seeders;

use App\Models\Tarefa;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $usuario = Usuario::first();
        Tarefa::create([
            'descricao' => 'Teste',
            'data'      => date('Y-m-d'),
            'usuario_id'=> $usuario->id,
            'imagem'    => 'teste.png'
        ]);

        Tarefa::create([
            'descricao' => 'Teste 2',
            'data'      => date('Y-m-d', mktime(0, 0, 0, date('m')+2, date('d'), date('Y'))),
            'usuario_id'=> $usuario->id,
            'imagem'    => 'teste.png'
        ]);
    }
}
