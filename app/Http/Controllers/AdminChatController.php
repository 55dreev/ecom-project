<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageSent;
use App\Models\User;
use App\Models\Message;

class AdminChatController extends Controller
{
    public function index()
    {
        // Get distinct users who have chatted with the admin
        $users = Message::where('receiver_id', 2) // admin ID
            ->orWhere('sender_id', 2)
            ->get()
            ->pluck('sender_id')
            ->merge(
                Message::where('receiver_id', 1)->pluck('receiver_id')
            )
            ->unique()
            ->filter(fn($id) => $id != 2)
            ->values();

        $userList = User::whereIn('id', $users)->get();

        return view('admin.chat-dashboard', compact('userList'));
    }

    public function fetchUserMessages($id)
    {
        $adminId = 2;

        $messages = Message::where(function ($q) use ($id, $adminId) {
            $q->where('sender_id', $id)->where('receiver_id', $adminId);
        })->orWhere(function ($q) use ($id, $adminId) {
            $q->where('sender_id', $adminId)->where('receiver_id', $id);
        })->orderBy('created_at')->get();
        
        return response()->json($messages);
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:255']);

        $message = Message::create([
            'sender_id' => 2,
            'receiver_id' => $id,
            'message' => $request->message
        ]);

        broadcast(new ChatMessageSent($message))->toOthers();

        return response()->json($message);
    }
}

