@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Livros na lixeira
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => 'trashed.books.index', 'class' => 'form-inline text-right']) !!}
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
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Preço</th>
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ str_limit($book->title, 50) }}</td>
                                        <td>{{ $book->user->name }}</td>
                                        <td>{{ $book->price }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('trashed.books.show', ['id' => $book->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            <a href="{{ route('trashed.books.update', ['id' => $book->id]) }}"
                                               class="btn btn-primary btn-xs js-restore">Restaurar</a>
                                            <a href="{{ route('trashed.books.destroy', ['id' => $book->id]) }}"
                                               class="btn btn-danger btn-xs js-destroy-trashed">Deletar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Nenhum livro excluído.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
