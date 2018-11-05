<?php

namespace App\Http\Controllers\Migracion\Generaccion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneraccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function noticias()
    {
        
    }
}