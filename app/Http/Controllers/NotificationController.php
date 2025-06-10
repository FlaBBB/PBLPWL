<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $notifications = Notification::where('id_user', $user->id)->latest()->get();
        return response()->json($notifications);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read.']);
    }

    public function markAllAsRead()
    {
        Notification::where('id_user', auth()->user()->id)->whereNull('read_at')->update(['read_at' => now(), 'is_read' => true]);
        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
