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
            $arrayLinks = [
                [
                    'Segurança',
                    [
                        [
                            'link' => route('users.index'),
                            'title' => 'Usuários',
                            'permission' => 'codeuser-users/list',
                        ],
                        [
                            'link' => route('roles.index'),
                            'title' => 'Papéis',
                            'permission' => 'codeuser-roles/list',
                        ],
                    ],
                ],
                [
                    'link' => route('categories.index'),
                    'title' => 'Categorias',
                    'permission' => 'codebook-categories/list',
                ],
                [
                    'link' => route('books.index'),
                    'title' => 'Livros',
                    'permission' => 'codebook-books/list',
                ],
                [
                    'Lixeira',
                    [
                        [
                            'link' => route('trashed.books.index'),
                            'title' => 'Livros',
                            'permission' => 'codebook-books-trashed/list',
                        ],
                    ],
                ],
            ];

            $links = Navigation::links(NavbarAuthorization::getLinksAuthorized($arrayLinks));

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
