<?php

namespace App\Http\Controllers;

use App\Repository\ParserRepository;

class ParserController extends Controller
{


    public function initParser($resourceName): \Illuminate\Http\RedirectResponse
    {
        if (method_exists($this, $resourceName)) {
            return $this->{$resourceName}(new ParserRepository());
        }
        return back();
    }

    private function lenta(ParserRepository $repository): \Illuminate\Http\RedirectResponse
    {
        return $repository->parseLentaNews();
    }

    private function yandex(ParserRepository $repository): \Illuminate\Http\RedirectResponse
    {
        return $repository->parseYandexNews();
    }
}
