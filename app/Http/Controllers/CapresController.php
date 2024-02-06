<?php

namespace App\Http\Controllers;

use App\Services\CapresService;
use Illuminate\Http\Request;

class CapresController extends Controller
{
    public function index()
    {
        $service = new CapresService();
        $datum = $service->getCapres();

        return view('capres', compact('datum'));
    }
}
