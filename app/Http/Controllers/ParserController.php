<?php

namespace App\Http\Controllers;

use App\Services\ParserService;

class ParserController extends Controller
{


    public function initParser($resourceName): \Illuminate\Http\RedirectResponse
    {
        if (method_exists($this, $resourceName)) {
            return $this->{$resourceName}(new ParserService());
        }
        return back();
    }

    private function lenta(ParserService $parser)
    {
        return $parser->parseLentaNews();
    }

    private function yandex(ParserService $parser)
    {
        return $parser->parseYandexNews();
    }
}
