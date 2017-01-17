@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ empty($user) ? 'Adicionar Usuário' : 'Atualizar Usuário' }}
                    </div>

                    <div class="panel-body">
                        @if(!empty($user))
                            {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => 'users.store']) !!}
                        @endif

                        {!! Form::hidden('_previous', URL::previous()) !!}

                        {!! Html::openFormGroup('name', $errors) !!}
                        {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! Form::error('name', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        {!! Html::openFormGroup('email', $errors) !!}
                        {!! Form::label('email', 'E-mail:', ['class' => 'control-label']) !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        {!! Form::error('email', $errors) !!}
                        {!! Html::closeFormGroup() !!}

                        @if(empty($user))
                            {!! Html::openFormGroup('password', $errors) !!}
                            {!! Form::label('password', 'Senha:', ['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            {!! Form::error('password', $errors) !!}
                            {!! Html::closeFormGroup() !!}

                            {!! Html::openFormGroup('password_confirmation', $errors) !!}
                            {!! Form::label('password_confirmation', 'Confirmação de senha:', ['class' => 'control-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            {!! Form::error('password_confirmation', $errors) !!}
                            {!! Html::closeFormGroup() !!}
                        @endif

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
