<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Chat;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::all();
        return view('customizations.index', compact('customizations'));
    }

    public function create()
    {
        return view('customizations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'custom_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'custom_message' => 'required|string|max:500',
        ]);

        $imagePath = $request->file('custom_image')->store('custom_images', 'public');

        Customization::create([
            'user_id' => auth()->id(),
            'product_name' => $request->product_name,
            'custom_image' => $imagePath,
            'custom_message' => $request->custom_message,
        ]);

        return redirect()->route('customizations.index')->with('success', 'Customization created successfully.');
    }
    public function chat($id)
    {
        $messages = Chat::where('customization_id', $id)->get();
        return view('customizations.chat', compact('messages', 'id'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'customization_id' => 'required|exists:customizations,id',
        ]);

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => auth()->id() == 1 ? 2 : 1, // Admin = 1, User = 2
            'customization_id' => $request->customization_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
}