<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConversionEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_conversion_event_can_be_recorded(): void
    {
        $this->post('/conversion-events', [
            'event_type' => 'whatsapp',
            'source_url' => '/contact-us',
        ])->assertNoContent();

        $this->assertDatabaseHas('conversion_events', [
            'event_type' => 'whatsapp',
            'source_url' => '/contact-us',
        ]);
    }

    public function test_unknown_conversion_event_is_rejected(): void
    {
        $this->post('/conversion-events', [
            'event_type' => 'share',
            'source_url' => '/artikel/example',
        ])->assertSessionHasErrors('event_type');

        $this->assertDatabaseCount('conversion_events', 0);
    }
}
