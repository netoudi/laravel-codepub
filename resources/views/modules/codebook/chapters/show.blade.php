@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Capítulo de <strong>{{ $book->title }}</strong>
                        <a href="{{ URL::previous() }}" class="btn btn-primary btn-xs pull-right">
                            &laquo; Voltar
                        </a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <dl class="dl-horizontal text-overflow">
                                <dt><strong>Id:</strong></dt>
                                <dd>{{ $chapter->id }}</dd>

                                <hr>
                                <dt><strong>Nome:</strong></dt>
                                <dd>{{ $chapter->name }}</dd>

                                <hr>
                                <dt><strong>Conteúdo:</strong></dt>
                                <dd>{{ $chapter->content }}</dd>

                                <hr>
                                <dt><strong>Ordem:</strong></dt>
                                <dd>{{ $chapter->order }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
