<?php

namespace App\Http\Controllers;

use App\Services\ParserService;

class ParserController extends Controller
{
    public function parser(ParserService $parser): \Illuminate\Http\RedirectResponse
    {
        return $parser->parse();
    }
}
