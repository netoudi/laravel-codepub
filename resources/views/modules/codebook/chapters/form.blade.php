@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ empty($chapter) ? 'Adicionar Capítulo' : 'Atualizar Capítulo' }} - <strong>{{ $book->title }}</strong>
                    </div>

                    <div class="panel-body">
                        @if(!empty($chapter))
                            {!! Form::model($chapter, ['method' => 'PUT', 'route' => ['chapters.update', 'book' => $chapter->book_id, 'chapter' => $chapter->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => ['chapters.store', 'book' => $book->id]]) !!}
                        @endif

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('name', $errors) !!}
                        {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! Form::error('name', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('content', $errors) !!}
                        {!! Form::label('content', 'Conteúdo:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                        {!! Form::error('content', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('order', $errors) !!}
                        {!! Form::label('order', 'Ordem:', ['class' => 'control-label']) !!}
                        {!! Form::number('order', null, ['class' => 'form-control']) !!}
                        {!! Form::error('order', $errors) !!}
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

@include('codebook::chapters._ckeditor')
