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
            $links = [];

            if (Auth::user()->can('codeuser-users/list')) {
                $links[] = ['Segurança', [['link' => route('users.index'), 'title' => 'Usuários']]];
            }

            if (Auth::user()->can('codeuser-roles/list')) {
                if (count($links)) {
                    $links[0][1][] = ['link' => route('roles.index'), 'title' => 'Papéis'];
                } else {
                    $links[] = ['Segurança', [['link' => route('roles.index'), 'title' => 'Papéis']]];
                }
            }

            if (Auth::user()->can('codebook-categories/list')) {
                $links[] = ['link' => route('categories.index'), 'title' => 'Categorias'];
            }

            if (Auth::user()->can('codebook-books/list')) {
                $links[] = ['link' => route('books.index'), 'title' => 'Livros'];
            }

            if (Auth::user()->can('codebook-books-trashed/list')) {
                $links[] = ['Lixeira', [['link' => route('trashed.books.index'), 'title' => 'Livros']]];
            }

            $links = Navigation::links($links);

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
