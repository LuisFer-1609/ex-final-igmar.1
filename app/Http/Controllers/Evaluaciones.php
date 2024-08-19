<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Evaluaciones extends Controller
{
    function resta() {
        return view('resta');
    }

    function multiplicacion() {
        return view('multiplicacion');

    }

    function division() {
        return view('division');

    }
}
