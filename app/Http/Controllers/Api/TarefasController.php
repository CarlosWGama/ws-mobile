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
        $validation = Validator::make($request->tarefa, [
            'descricao' => 'required',
            'data'      => 'required'
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);

        //Inicio cadastro de Tarefa
        $tarefa = $request->tarefa;
        //Converte a data de d/m/Y para Y-m-d
        $tarefa['data'] = implode('-', array_reverse(explode('/', $tarefa['data'])));
        $tarefa['usuario_id'] = 1; //Fixo por enquanto
        unset($tarefa['imagem']); //Remove para não salvar a imagem como base64 no banco. 

        //Salva a Tarefa
        $tarefa = Tarefa::create($tarefa);
        
        //Caso tenha imagem, salva a imagem
        if (!empty($request->tarefa['imagem'])) {
            $tarefa->imagem = $imagem = 'tarefa_'.$tarefa->id.'.jpg';
            $this->salvarImagem($request->tarefa['imagem'], $imagem);
            $tarefa->save();
        }
        return response()->json($tarefa, 201);
    }

    /** Lista tarefas de um usuário */
    public function listar(Request $request) {
        $usuarioID = 1;
        $tarefas = Tarefa::where('usuario_id', $usuarioID)->get();
        return response()->json($tarefas, 200);
    }

    /** Busca uma tarefa do usuário
     * @param $id | id da tarefa
     */
    public function buscar(Request $request, int $id) {
        $usuarioID = 1;
        $tarefa = Tarefa::where('id', $id)->where('usuario_id', $usuarioID)->firstOrFail();
        return response()->json($tarefa, 200);
    }

    /** Atualiza uma tarefa de um usuário */
    public function atualizar(Request $request, int $id) {
        $usuarioID = 1;
        $tarefa = Tarefa::where('id', $id)->where('usuario_id', $usuarioID)->firstOrFail();

        $validation = Validator::make($request->tarefa, [
            'descricao' => 'required',
            'data'      => 'required'
        ]);

        if ($validation->fails()) return response()->json($validation->errors(), 400);
        
        //Busca descricao e data da tarefa
        $tarefa->descricao = $request->tarefa['descricao'];
        //Converte a data de d/m/Y para Y-m-d
        $tarefa->data = implode('-', array_reverse(explode('/', $request->tarefa['data'])));

        //Caso tenha imagem, salva a imagem
        if (!empty($request->tarefa['imagem']) && substr($request->tarefa['imagem'], 0, 4) == 'data') {
            $tarefa->imagem = $imagem = 'tarefa_'.$tarefa->id.'.jpg';
            $this->salvarImagem($request->tarefa['imagem'], $imagem);
        }
        
        $tarefa->save();
        return response()->json($tarefa, 200);
    }

    /**
     * Remove uma Tarefa do sistema
     * @param $id | id da tarefa
     */
    public function remover(Request $request, int $id) {
        $usuarioID = 1;
        $tarefa = Tarefa::where('usuario_id', $usuarioID)->where('id', $id)->firstOrFail();
        $tarefa->delete();
        return response()->json('Tarefa excluída com sucesso', 200);
    }

    /** 
     * Recebe a imagem na base64
     * @param $uriBase64 | Imagem com toda URI data:image/png;base64,
     * @param $nomeArquivo | Qual nome do arquivo para ser salvo
     */
    private function salvarImagem(string $uriBase64, string $nomeArquivo) {
        $vetor = explode(',', $uriBase64);
        $imagemBase64 = end($vetor);
        
        file_put_contents(storage_path('app/public/'.$nomeArquivo), base64_decode($imagemBase64));
    }
}
