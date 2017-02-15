@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Permissões de <strong>{{ $role->name }}</strong>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['method' => 'PUT', 'route' => ['roles.permissions.update', $role->id]]) !!}

                        @foreach($permissionsGroup as $group)
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        <strong>{{ $group->description }}</strong>
                                    </h4>
                                    <span class="list-group-item-text">
                                        <ul class="list-inline">
                                            <?php $permissionsSubGroup = $permissions->filter(
                                                function ($permission) use ($group) {
                                                    return $permission->name = $group->name;
                                                });
                                            ?>
                                            @foreach($permissionsSubGroup as $permission)
                                                <li>
                                                    <div class="checkbox">
                                                        <label for="permission_{{ $permission->id }}">
                                                            <input type="checkbox" name="permissions[]"
                                                                   id="permission_{{ $permission->id }}"
                                                                   value="{{ $permission->id }}"
                                                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked="checked"' : '' }}>
                                                            {{ $permission->resource_description }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </span>
                                </li>
                            </ul>
                        @endforeach

                        <hr>

                        <div class="form-group text-right">
                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary btn-sm']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ route('roles.index') }}"
                               role="button">Cancelar</a>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
