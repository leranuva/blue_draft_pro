<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PillarPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LeadMagnetController;
use App\Http\Controllers\CostCalculatorController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\PillarCityController;
use App\Http\Controllers\PresentationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/evaluacion-proyecto', [PresentationController::class, 'show'])->name('presentation');
Route::get('/project-proposal', [ProjectProposalController::class, 'show'])->name('project-proposal');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit')->middleware('throttle:5,1');

// Quote multi-step: guardado parcial (Step 1) y completado (Step 2)
Route::post('/quote/partial', [QuoteController::class, 'savePartial'])->name('quote.partial');
Route::post('/quote/complete', [QuoteController::class, 'complete'])->name('quote.complete')->middleware('throttle:5,1');

// Phase 2: SEO landing pages - /services y /blog redirigen a la landing
Route::redirect('/services', '/#services', 301)->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/construction-company-new-york', [PillarPageController::class, 'show'])->name('pillar.nyc');
Route::get('/construction-company-{city}', [PillarCityController::class, 'show'])
    ->where('city', implode('|', array_keys(config('pillar_cities.cities', []))))
    ->name('pillar.city');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Phase 5: Lead Magnet & Cost Calculator
Route::get('/free-renovation-guide', [LeadMagnetController::class, 'show'])->name('lead-magnet.show');
Route::post('/free-renovation-guide', [LeadMagnetController::class, 'submit'])->name('lead-magnet.submit')->middleware('throttle:5,1');
Route::get('/free-renovation-guide/guide', [LeadMagnetController::class, 'guide'])->name('lead-magnet.guide');
Route::get('/cost-calculator', [CostCalculatorController::class, 'show'])->name('cost-calculator');
