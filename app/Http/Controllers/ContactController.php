<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    private const RULES = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ];

    public function store(Request $request)
    {
        $data = $request->validate(self::RULES);
        Message::create($data);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda sudah terkirim.');
    }

    public function storeAjax(Request $request)
    {
        // Honeypot: real visitors never fill the hidden "website" field.
        if ($request->filled('website')) {
            return response()->json(['success' => true]);
        }

        $validator = Validator::make($request->all(), self::RULES);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        Message::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! I will get back to you soon.',
        ]);
    }
}
