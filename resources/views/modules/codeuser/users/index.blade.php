@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuários
                        @can('codeuser-users/store')
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-xs pull-right">
                                Novo Usuário
                            </a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => 'users.index', 'class' => 'form-inline text-right']) !!}
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::text('search', null, ['class' => 'form-control input-sm', 'placeholder' => 'O que você deseja buscar?']) !!}
                                <div class="input-group-btn">
                                    {!! Form::submit('Buscar', ['class'=>'btn btn-primary btn-sm']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        @if(!empty($search))
                            <h4>Resultado da busca: {{ $search }}</h4>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="5%">Id</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Papel</th>
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->implode('name', ' | ') }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('users.show', ['id' => $user->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            @can('codeuser-users/update')
                                                <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                                   class="btn btn-primary btn-xs">Editar</a>
                                            @endcan
                                            @if(Auth::user()->id == $user->id)
                                                @can('codeuser-users/destroy')
                                                    <a class="btn btn-danger btn-xs"
                                                       title="Não é possível excluir o próprio usuário"
                                                       data-toggle="tooltip" data-placement="top" disabled="disabled">Deletar</a>
                                                @endcan
                                            @else
                                                @can('codeuser-users/destroy')
                                                    <a href="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                       class="btn btn-danger btn-xs js-destroy">Deletar</a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhum usuário cadastrado.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
