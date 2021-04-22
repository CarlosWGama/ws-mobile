<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarefa;
/**
 * @package API
 * Classe responsável por Controlar as requisições da API envolvendo usuário
 */
class TarefasController extends Controller {
    
    /** Cadastra uma nova tarefa */
    public function cadastrar(Request $request) {
       
    }

    /** Lista tarefas de um usuário */
    public function listar(Request $request) {
      
    }

    /** Busca uma tarefa do usuário
     * @param $id | id da tarefa
     */
    public function buscar(Request $request, int $id) {
       
    }

    /** Atualiza uma tarefa de um usuário */
    public function atualizar(Request $request, int $id) {
       
    }

    /**
     * Remove uma Tarefa do sistema
     * @param $id | id da tarefa
     */
    public function remover(Request $request, int $id) {
    
    }

    /** 
     * Recebe a imagem na base64
     * @param $uriBase64 | Imagem com toda URI data:image/png;base64,
     * @param $nomeArquivo | Qual nome do arquivo para ser salvo
     */
    private function salvarImagem(string $uriBase64, string $nomeArquivo) {
      
    }
}
