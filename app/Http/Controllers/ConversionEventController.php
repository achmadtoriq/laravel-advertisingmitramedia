<?php

namespace App\Http\Controllers;

use App\Models\ConversionEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConversionEventController extends Controller
{
    public function store(Request $request): Response
    {
        $data = $request->validate([
            'event_type' => 'required|in:whatsapp,phone',
            'source_url' => 'nullable|string|max:2048',
        ]);

        ConversionEvent::create($data);

        return response()->noContent();
    }
}
