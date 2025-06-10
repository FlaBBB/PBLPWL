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
        $notifications = $user->notifications()->whereNull('read_at')->latest()->get();
        return response()->json($notifications);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read.']);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
