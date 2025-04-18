<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageSent;
use App\Models\Message;

class ChatController extends Controller
{
    public function send(Request $request)
{
    $request->validate(['message' => 'required|string|max:255']);

    $userId = auth()->id();
    $adminId = 2;

    // Save the message
    $message = Message::create([
        'sender_id' => $userId,
        'receiver_id' => $adminId,
        'message' => $request->message,
    ]);

    broadcast(new ChatMessageSent($message))->toOthers();

    return response()->json(['status' => 'Message sent', 'message' => $message]);
}

public function fetch()
{
    $adminId = 2;
    $userId = auth()->id();

    $messages = Message::where(function ($query) use ($userId, $adminId) {
        $query->where('sender_id', $userId)->where('receiver_id', $adminId);
    })->orWhere(function ($query) use ($userId, $adminId) {
        $query->where('sender_id', $adminId)->where('receiver_id', $userId);
    })->orderBy('created_at')->get();
    
    return response()->json($messages);
}


}
