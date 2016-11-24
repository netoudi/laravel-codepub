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
