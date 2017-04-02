@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cover de <strong>{{ $book->title }}</strong>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['method' => 'POST', 'route' => ['books.cover.store', $book->id], 'files' => true]) !!}

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('file', $errors) !!}
                        {!! Form::label('file', 'Cover (formato aceito: .jpg):', ['class' => 'control-label']) !!}
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                        {!! Form::error('file', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        <hr>

                        <div class="form-group text-right">
                            {!! Form::submit('Upload', ['class'=>'btn btn-primary btn-sm']) !!}
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
