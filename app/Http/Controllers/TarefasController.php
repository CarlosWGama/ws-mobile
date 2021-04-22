<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefasController extends Controller {
    
    private $dados = ['menu' => 'tarefas'];

    /** Tela inicial com a listagem de tarefas */
    public function index() {
        $this->dados['tarefas'] = Tarefa::paginate(10);
        return view('tarefas.listar', $this->dados);
    }   

    /**
     * Remove um tarefa cadastrada
     * @param $id id da tarefa
     */
    public function excluir(int $id) {
        Tarefa::destroy($id);
        return redirect()->route('tarefas.listar')->with('sucesso', 'Tarefa excluida');
    }

}
