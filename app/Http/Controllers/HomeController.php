<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;


class HomeController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Energia Social API'], Response::HTTP_OK);
    }
}

