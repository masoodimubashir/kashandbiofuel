<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index(Request $request)
    {


        $query = auth()->user()->unreadNotifications();

        if ($request->filter === 'read') {
            $query->whereNotNull('read_at');
        } elseif ($request->filter === 'unread') {
            $query->whereNull('read_at');
        }

        $notifications = $query->latest()->paginate(10);


        return view('layouts.dashboard.Notification.view-notification', compact('notifications'));
    }

    public function markAsRead($id)
    {

        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();

        
    }
}
