<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaludoController extends Controller
{
    public function index()
    {
        $mensaje = "¡Hola Mundo desde el Controlador de Laravel! 🚀";
        return view('saludo', compact('mensaje'));
    }
}
