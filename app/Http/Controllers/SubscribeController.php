<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeNotification;
use App\Models\Subscriber;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:subscribers,email',
            'no_hp' => 'required|string|max:15',
        ]);

        try {
            Subscriber::create($validated);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.']);
        }
    }
} 
