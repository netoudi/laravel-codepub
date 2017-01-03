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

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-destroy').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente deletar o registro?')) {
                    destroy($(this).attr('href'));
                }
            });

            $('.js-destroy-trashed').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente deletar o registro?')) {
                    if (confirm('Não será mais possivel restaurar o registro.\nDeseja continuar exclução?')) {
                        destroy($(this).attr('href'));
                    }
                }
            });

            $('.js-restore').on('click', function (event) {
                event.preventDefault();

                if (confirm('Deseja realmente restaurar o registro?')) {
                    restore($(this).attr('href'));
                }
            });
        });

        function destroy(href) {
            var form, input;

            form = document.createElement('form');

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = Laravel.csrfToken;
            form.appendChild(input);

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'DELETE';
            form.appendChild(input);

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_previous';
            input.value = Laravel.urlFull;
            form.appendChild(input);

            form.setAttribute('method', 'POST');

            form.setAttribute('action', href);

            $(form).submit();
        }

        function restore(href) {
            var form, input;

            form = document.createElement('form');

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = Laravel.csrfToken;
            form.appendChild(input);

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PUT';
            form.appendChild(input);

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_previous';
            input.value = Laravel.urlFull;
            form.appendChild(input);

            form.setAttribute('method', 'POST');

            form.setAttribute('action', href);

            $(form).submit()

            console.log(form);
        }
    </script>
</body>
</html>
