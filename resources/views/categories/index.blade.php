@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categorias
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-xs pull-right">
                            Nova Categoria
                        </a>
                    </div>

                    <div class="panel-body">
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
                                            <a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                                               class="btn btn-primary btn-xs">Editar</a>
                                            <a href="{{ route('categories.destroy', ['id' => $category->id]) }}"
                                               class="btn btn-danger btn-xs">Deletar</a>
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
