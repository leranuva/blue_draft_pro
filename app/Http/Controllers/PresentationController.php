<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PresentationController extends Controller
{
    public function show(): View
    {
        return view('presentation.evaluacion');
    }
}
