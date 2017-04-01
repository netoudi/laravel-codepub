<?php

namespace Modules\CodeUser\Menu;

use Illuminate\Support\Facades\Auth;

class Navbar
{
    public function getLinksAuthorized($links)
    {
        $linksAuthorized = [];

        foreach ($links as $link) {
            if (isset($link[0])) { // menu dropdown
                $l = $this->getLinksAuthorized($link[1]);
                if (count($l)) {
                    $linksAuthorized[] = [
                        $link[0],
                        $l,
                    ];
                }
            } elseif (Auth::user()->can($link['permission'])) {
                $linksAuthorized[] = $link;
            }
        }

        return $linksAuthorized;
    }
}
