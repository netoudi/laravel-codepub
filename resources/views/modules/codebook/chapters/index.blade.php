@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Capítulos de <strong>{{ $book->title }}</strong>
                        @can('codebook-chapters/store')
                            <a href="{{ route('chapters.create', ['book' => $book->id]) }}"
                               class="btn btn-primary btn-xs pull-right">
                                Novo Capítulo
                            </a>
                        @endcan
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-xs pull-right">
                            &laquo; Voltar
                        </a>
                    </div>

                    <div class="panel-body">
                        {!! Form::model(compact('search'), ['method' => 'GET', 'route' => ['chapters.index', $book->id], 'class' => 'form-inline text-right']) !!}
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
                                    <th>Conteúdo</th>
                                    <th width="10%">Ordem</th>
                                    <th width="5%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($chapters as $chapter)
                                    <tr>
                                        <td>{{ $chapter->id }}</td>
                                        <td>{{ str_limit($chapter->name, 30) }}</td>
                                        <td>{{ str_limit($chapter->content, 30) }}</td>
                                        <td>{{ $chapter->order }}</td>
                                        <td nowrap="nowrap">
                                            <a href="{{ route('chapters.show', ['book' => $chapter->book_id, 'chapter' => $chapter->id]) }}"
                                               class="btn btn-primary btn-xs">Vizualizar</a>
                                            @can('codebook-chapters/update')
                                                <a href="{{ route('chapters.edit', ['book' => $chapter->book_id, 'chapter' => $chapter->id]) }}"
                                                   class="btn btn-primary btn-xs">Editar</a>
                                            @endcan
                                            @can('codebook-chapters/destroy')
                                                <a href="{{ route('chapters.destroy', ['book' => $chapter->book_id, 'chapter' => $chapter->id]) }}"
                                                   class="btn btn-danger btn-xs js-destroy">Deletar</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhum capítulo cadastrado.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $chapters->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
