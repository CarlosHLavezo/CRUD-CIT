<?php

namespace App\Http\Controllers;

use App\Service\InscricaoService;

class HomeController extends Controller
{

    private $inscricaoService;

    public function __construct(InscricaoService $inscricaoService)
    {
        $this->middleware('auth');

        $this->inscricaoService = $inscricaoService;
    }

    public function index()
    {
        return view('home', ['inscricoes' => $this->inscricaoService->consultarUltimasDez()]);
    }
}
