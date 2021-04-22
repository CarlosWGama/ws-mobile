@extends('template')

@section('titulo', 'Tarefas')

@section('conteudo')
<div class="user-data m-b-30">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-account-calendar"></i>Tarefas Cadastradas</h3>
        

        <div class="table-responsive table-data">
                @if(session('sucesso'))
                <div class="alert alert-success" role="alert" style="margin:0px 10px">
                    {{session('sucesso')}}
                </div>
                @endif
            <table class="table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Descrição</td>
                        <td>Dono</td>
                        <td>Data</td>
                        <td>Opções</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarefas as $tarefa)
                    <tr>
                        <!-- ID -->
                        <td><h6>{{$tarefa->id}}</h6></td>
                        <!-- DESCRIÇÃO -->
                        <td><h6>{{$tarefa->descricao}}</h6></td>
                        <!-- DONO -->
                        <td><h6>{{$tarefa->usuario->nome}}</h6></td>
                        <!-- DATA -->
                        <td><h6>{{$tarefa->data}}</h6></td>
                        <!-- OPÇÕES -->   
                        <td>
                            <span class="more remover-modal" data-toggle="modal" data-target="#smallmodal" data-id="{{$tarefa->id}}"><i class="zmdi zmdi-delete"></i></span>               
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        <!-- Paginação -->
        <div style="padding:10px">{{$tarefas->links()}}</div>
        
        </div>
      
    </div>

@push('javascript')
  <!-- modal small -->
  <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Remover Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                       Deseja Realmente excluir essa tarefa?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-deletar">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->

    <script>
        let tarefaID;
        $('.remover-modal').click(function() {
            tarefaID = $(this).data('id');
        })

        $('.btn-deletar').click(() => window.location.href="{{route('tarefas.excluir')}}/"+tarefaID);
    </script>
@endpush
@endsection