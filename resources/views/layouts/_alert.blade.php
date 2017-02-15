@if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul class="list-group list-unstyled">
            @foreach($errors->all() as $error)
                <li class="list-group-item-danger"><i class="glyph-icon icon-caret-right"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    {!! Alert::success(session('success'))->close() !!}
@endif

@if (session('info'))
    {!! Alert::info(session('info'))->close() !!}
@endif

@if (session('warning'))
    {!! Alert::warning(session('warning'))->close() !!}
@endif

@if (session('danger'))
    {!! Alert::danger(session('danger'))->close() !!}
@endif
