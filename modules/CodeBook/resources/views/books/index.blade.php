@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Livros
                        @can('codebook-books/store')
                            <a href="{{ route('books.create') }}" class="btn btn-primary btn-xs pull-right">
                                Novo Livro
                            </a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => 'books.index', 'class' => 'form-inline text-right']) !!}
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
                                        @if(file_exists($book->zip_file))
                                            <td>
                                                <a href="{{ route('books.download', ['book' => $book->id]) }}"
                                                   target="_blank">{{ str_limit($book->title, 50) }}</a>
                                            </td>
                                        @else
                                            <td>{{ str_limit($book->title, 50) }}</td>
                                        @endif
                                        <td>{{ $book->user->name_trashed }}</td>
                                        <td>{{ $book->price }}</td>
                                        <td nowrap="nowrap">
                                            @can('codebook-books/export')
                                                <a href="{{ route('books.export', ['book' => $book->id]) }}"
                                                   class="btn btn-warning btn-xs">Exportar</a>
                                            @endcan
                                            @can('codebook-chapters/list')
                                                <a href="{{ route('chapters.index', ['book' => $book->id]) }}"
                                                   class="btn btn-info btn-xs">Capítulos</a>
                                            @endcan
                                            @can('codebook-books/cover')
                                                <a href="{{ route('books.cover.create', ['book' => $book->id]) }}"
                                                   class="btn btn-success btn-xs">Cover</a>
                                            @endcan
                                            <a href="{{ route('books.show', ['id' => $book->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            @can('codebook-books/update')
                                                <a href="{{ route('books.edit', ['id' => $book->id]) }}"
                                                   class="btn btn-primary btn-xs">Editar</a>
                                            @endcan
                                            @can('codebook-books/destroy')
                                                <a href="{{ route('books.destroy', ['id' => $book->id]) }}"
                                                   class="btn btn-danger btn-xs js-destroy">Deletar</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhum livro cadastrado.</td>
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
