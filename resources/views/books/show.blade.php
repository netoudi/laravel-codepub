@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Livro
                        <a href="{{ URL::previous() }}" class="btn btn-primary btn-xs pull-right">
                            &laquo; Voltar
                        </a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <dl class="dl-horizontal text-overflow">
                                <dt><strong>Id:</strong></dt>
                                <dd>{{ $book->id }}</dd>

                                <hr>
                                <dt><strong>Título:</strong></dt>
                                <dd>{{ $book->title }}</dd>

                                <hr>
                                <dt><strong>Subtítulo:</strong></dt>
                                <dd>{{ $book->subtitle }}</dd>

                                <hr>
                                <dt><strong>Autor:</strong></dt>
                                <dd>{{ $book->user->name }}</dd>

                                <hr>
                                <dt><strong>Preço:</strong></dt>
                                <dd>{{ $book->price }}</dd>

                                <hr>
                                <dt><strong>Categorias:</strong></dt>
                                <dd>
                                    <ul class="list-inline">
                                        @foreach($book->categories as $category)
                                            <li>{{ $category->name }};</li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
