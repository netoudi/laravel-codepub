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

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('title', $errors) !!}
                        {!! Form::label('title', 'Título:', ['class' => 'control-label']) !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        {!! Form::error('title', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('subtitle', $errors) !!}
                        {!! Form::label('subtitle', 'Subtítulo:', ['class' => 'control-label']) !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                        {!! Form::error('subtitle', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('price', $errors) !!}
                        {!! Form::label('price', 'Preço:', ['class' => 'control-label']) !!}
                        {!! Form::text('price', null, ['class' => 'form-control']) !!}
                        {!! Form::error('price', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup(['categories', 'categories.*'], $errors) !!}
                        {!! Form::label('categories[]', 'Categorias:', ['class' => 'control-label']) !!}
                        {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => true]) !!}
                        {!! Form::error('categories', $errors) !!}
                        {!! Form::error('categories.*', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        <hr>

                        <div class="form-group text-right">
                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary btn-sm']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ URL::previous() }}"
                               role="button">Cancelar</a>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
