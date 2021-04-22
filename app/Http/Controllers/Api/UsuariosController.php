<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
/**
 * @package API
 * Classe responsável por Controlar as requisições da API envolvendo usuário
 */
class UsuariosController extends Controller {
    
    /** Loga o usuário */
    public function logar(Request $request) {
        $usuario = Usuario::where('email', $request->email)
                            ->where('senha', md5($request->senha))
                            ->firstOrFail(); //Senão achar retorna 404
        return response()->json($usuario, 200);
    }


    /** Cadastra um novo usuário */
    public function registrar(Request $request) {

        $validation = Validator::make($request->usuario, [
            'nome'  => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        } else {
            $usuario = $request->usuario;
            $usuario['senha'] = md5($usuario['senha']);
            $usuario = Usuario::create($usuario);
            return response()->json($usuario, 201);
        }
    }
}
