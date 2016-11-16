@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria
                        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-xs pull-right">
                            &laquo; Voltar
                        </a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <dl class="dl-horizontal text-overflow">
                                <dt><strong>Id:</strong></dt>
                                <dd>{{ $category->id }}</dd>

                                <hr>
                                <dt><strong>Nome:</strong></dt>
                                <dd>{{ $category->name }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
