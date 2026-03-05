<?php

namespace Tests\Feature;

use App\Http\Middleware\CaptureUtmParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UtmCaptureTest extends TestCase
{
    public function test_middleware_stores_utm_content_in_session(): void
    {
        $request = Request::create('/test?utm_content=banner-cta');
        $request->setLaravelSession(app('session')->driver('array'));
        $middleware = new CaptureUtmParams;

        $response = $middleware->handle($request, fn () => response('ok'));

        $this->assertEquals('banner-cta', $request->session()->get('utm_content'));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_middleware_stores_all_utm_params(): void
    {
        $request = Request::create('/test?utm_source=google&utm_medium=cpc&utm_campaign=spring&utm_content=ad1');
        $request->setLaravelSession(app('session')->driver('array'));
        $middleware = new CaptureUtmParams;

        $middleware->handle($request, fn () => response('ok'));

        $this->assertEquals('google', $request->session()->get('utm_source'));
        $this->assertEquals('cpc', $request->session()->get('utm_medium'));
        $this->assertEquals('spring', $request->session()->get('utm_campaign'));
        $this->assertEquals('ad1', $request->session()->get('utm_content'));
    }
}
