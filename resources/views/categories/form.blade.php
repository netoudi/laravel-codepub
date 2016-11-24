@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ empty($category) ? 'Adicionar Categoria' : 'Atualizar Categoria' }}
                    </div>

                    <div class="panel-body">
                        @if(!empty($category))
                            {!! Form::model($category, ['method' => 'PUT', 'route' => ['categories.update', $category->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => 'categories.store']) !!}
                        @endif

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('name', $errors) !!}
                        {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! Form::error('name', $errors) !!}
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
