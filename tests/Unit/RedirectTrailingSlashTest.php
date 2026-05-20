<?php

namespace Tests\Unit;

use App\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Http\Request;
use Tests\TestCase;

class RedirectTrailingSlashTest extends TestCase
{
    public function test_public_trailing_slash_redirects_to_canonical_url(): void
    {
        $request = Request::create('/about-us/', 'GET');
        $response = (new RedirectTrailingSlash())->handle($request, fn () => response('ok'));

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame('http://localhost/about-us', $response->headers->get('location'));
    }

    public function test_public_trailing_slash_redirect_keeps_query_string(): void
    {
        $request = Request::create('/about-us/?utm_source=test', 'GET');
        $response = (new RedirectTrailingSlash())->handle($request, fn () => response('ok'));

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame('http://localhost/about-us?utm_source=test', $response->headers->get('location'));
    }

    public function test_home_does_not_redirect(): void
    {
        $request = Request::create('/', 'GET');
        $response = (new RedirectTrailingSlash())->handle($request, fn () => response('ok'));

        $this->assertSame(200, $response->getStatusCode());
    }
}
