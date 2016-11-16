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
                            {!! Form::model($category, ['method' => 'POST', 'route' => ['categories.update', $category->id]]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'route' => 'categories.store']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <hr>

                        <div class="form-group text-right">
                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary btn-sm']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ route('categories.index') }}"
                               role="button">Cancelar</a>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
