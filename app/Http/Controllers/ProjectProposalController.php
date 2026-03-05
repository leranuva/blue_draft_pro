<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectProposalController extends Controller
{
    /**
     * Display the project proposal presentation and usage guide.
     */
    public function show(): View
    {
        return view('pages.project-proposal');
    }
}
