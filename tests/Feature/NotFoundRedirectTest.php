<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotFoundRedirectTest extends TestCase
{
    public function test_public_not_found_redirects_to_home(): void
    {
        $this->get('/route-yang-tidak-ada')
            ->assertRedirect('/');
    }

    public function test_not_found_from_admin_referer_redirects_back_to_admin_referer(): void
    {
        $this->withHeader('referer', url('/admin/dashboard'))
            ->get('/route-yang-tidak-ada')
            ->assertRedirect('/admin/dashboard');
    }

    public function test_not_found_from_admin_root_referer_redirects_to_admin_dashboard(): void
    {
        $this->withHeader('referer', url('/admin'))
            ->get('/route-yang-tidak-ada')
            ->assertRedirect('/admin/dashboard');
    }

    public function test_admin_not_found_does_not_redirect_to_home(): void
    {
        $this->get('/admin/route-yang-tidak-ada')
            ->assertNotFound();
    }
}
