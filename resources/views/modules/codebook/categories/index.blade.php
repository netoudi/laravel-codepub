@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categorias
                        @can('codebook-categories/store')
                            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-xs pull-right">
                                Nova Categoria
                            </a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => 'categories.index', 'class' => 'form-inline text-right']) !!}
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
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('categories.show', ['id' => $category->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            @can('codebook-categories/update')
                                                <a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                                                   class="btn btn-primary btn-xs">Editar</a>
                                            @endcan
                                            @can('codebook-categories/destroy')
                                                <a href="{{ route('categories.destroy', ['id' => $category->id]) }}"
                                                   class="btn btn-danger btn-xs js-destroy">Deletar</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhuma categoria cadastrada.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
