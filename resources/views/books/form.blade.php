@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ empty($book) ? 'Adicionar Livro' : 'Atualizar Livro' }}
                    </div>

                    <div class="panel-body">
                        @if(!empty($book))
                            {!! Form::model($book, ['method' => 'PUT', 'route' => ['books.update', $book->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => 'books.store']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Título:', ['class' => 'control-label']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('subtitle', 'Subtítulo:', ['class' => 'control-label']) !!}
                            {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Preço:', ['class' => 'control-label']) !!}
                            {!! Form::text('price', null, ['class' => 'form-control']) !!}
                        </div>

                        <hr>

                        <div class="form-group text-right">
                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary btn-sm']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ route('books.index') }}"
                               role="button">Cancelar</a>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
