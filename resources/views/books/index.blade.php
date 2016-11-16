@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Livros
                        <a href="{{ route('books.create') }}" class="btn btn-primary btn-xs pull-right">
                            Novo Livro
                        </a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="5%">Id</th>
                                    <th>Título</th>
                                    <th>Subtítulo</th>
                                    <th>Preço</th>
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ str_limit($book->title, 50) }}</td>
                                        <td>{{ str_limit($book->subtitle, 40) }}</td>
                                        <td>{{ $book->price }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('books.show', ['id' => $book->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            <a href="{{ route('books.edit', ['id' => $book->id]) }}"
                                               class="btn btn-primary btn-xs">Editar</a>
                                            <a href="{{ route('books.destroy', ['id' => $book->id]) }}"
                                               class="btn btn-danger btn-xs"
                                               onclick=" event.preventDefault();
                                                       if (confirm('Deseja realmente deletar o registro?')) {
                                                       document.getElementById('form-delete-{{ $book->id }}').submit()
                                                       }
                                                       ">Deletar</a>
                                            {!!
                                                Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['books.destroy', $book->id],
                                                    'id' => 'form-delete-' . $book->id
                                                ])
                                            !!}
                                            {!! Form::close() !!}
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
