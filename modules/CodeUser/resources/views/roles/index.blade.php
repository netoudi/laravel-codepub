@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Papéis
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-xs pull-right">
                            Novo Papel
                        </a>
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => 'roles.index', 'class' => 'form-inline text-right']) !!}
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
                                    <th>Descrição</th>
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('roles.show', ['id' => $role->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            @if($role->name == config('codeuser.acl.role_admin'))
                                                <a href="#" class="btn btn-danger btn-xs disabled" title="Não é possível editar o papel padrão">Editar</a>
                                                <a href="#" class="btn btn-danger btn-xs disabled" title="Não é possível deletar o papel padrão">Deletar</a>
                                            @else
                                                <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                   class="btn btn-primary btn-xs">Editar</a>
                                                <a href="{{ route('roles.destroy', ['id' => $role->id]) }}"
                                                   class="btn btn-danger btn-xs js-destroy">Deletar</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhum papel cadastrado.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
