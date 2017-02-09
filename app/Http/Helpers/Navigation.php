<?php

if (!function_exists('navbar')) {
    /**
     * Generate navbar
     *
     * @return string
     */
    function navbar()
    {
        $form = "";
        $navbar = Navbar::withBrand(config('app.name'), url('/home'));

        if (Auth::check()) {
            $links = Navigation::links([
                [
                    'Segurança',
                    [
                        ['link' => route('users.index'), 'title' => 'Usuários'],
                        ['link' => route('roles.index'), 'title' => 'Papéis'],
                    ],
                ],
                ['link' => route('categories.index'), 'title' => 'Categorias'],
                ['link' => route('books.index'), 'title' => 'Livros'],
                [
                    'Lixeira',
                    [
                        ['link' => route('trashed.books.index'), 'title' => 'Livros'],
                    ],
                ],
            ]);

            $logout = Navigation::links([
                [
                    Auth::user()->name,
                    [
                        [
                            'link' => url('/logout'),
                            'title' => 'Logout',
                            'linkAttributes' => [
                                'onclick' => "event.preventDefault(); document.getElementById(\"logout-form\").submit();",
                            ],
                        ],
                    ],
                ],
            ])->right();

            $navbar->withContent($links)->withContent($logout);

            $form .= Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display:none']);
            $form .= Form::close();
        }

        return $navbar . $form;
    }
}
