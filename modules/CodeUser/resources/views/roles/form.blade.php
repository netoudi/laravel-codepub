@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ empty($role) ? 'Adicionar Papel' : 'Atualizar Papel' }}
                    </div>

                    <div class="panel-body">
                        @if(!empty($role))
                            {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => 'roles.store']) !!}
                        @endif

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('name', $errors) !!}
                        {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! Form::error('name', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('description', $errors) !!}
                        {!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        {!! Form::error('description', $errors) !!}
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
