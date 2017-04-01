<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'urlFull' => URL::full(),
            'urlCurrent' => URL::current(),
            'urlPrevious' => URL::previous(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        {!! navbar() !!}

        <div class="container">
            @include('layouts._alert')
        </div>

        @yield('content')
    </div>

    <form id="form-ajax" style="display: none;">
        <input type="hidden" name="_token">
        <input type="hidden" name="_method">
        <input type="hidden" name="_previous">
    </form>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.js-destroy').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente deletar o registro?')) {
                    formAjax('DELETE', $(this).attr('href'));
                }
            });

            $('.js-destroy-trashed').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente deletar o registro?')) {
                    if (confirm('Não será mais possivel restaurar o registro.\nDeseja continuar exclução?')) {
                        formAjax('DELETE', $(this).attr('href'));
                    }
                }
            });

            $('.js-restore').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente restaurar o registro?')) {
                    formAjax('PUT', $(this).attr('href'));
                }
            });
        });

        function formAjax(method, url) {
            var form = $('#form-ajax');

            form.attr('action', url);
            form.attr('method', 'POST');
            form.find('input[name=_token]').val(window.Laravel.csrfToken);
            form.find('input[name=_method]').val(method);
            form.find('input[name=_previous]').val(window.Laravel.urlFull);
            $(form).submit();
        }
    </script>
    @stack('scripts')
</body>
</html>
