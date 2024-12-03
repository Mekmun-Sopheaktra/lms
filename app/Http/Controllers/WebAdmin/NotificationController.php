<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationUpdateRequest;
use App\Models\Notification;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index', [
            'notifications' => NotificationRepository::query()->latest('id')->get(),
        ]);
    }

    public function edit(Notification $notification)
    {
        return view('notification.edit', [
            'notification' => $notification,
        ]);
    }

    public function update(NotificationUpdateRequest $request, Notification $notification)
    {
        NotificationRepository::updateByRequest($request, $notification);

        return to_route('notification.index')->withSuccess('Notification updated');
    }
}
