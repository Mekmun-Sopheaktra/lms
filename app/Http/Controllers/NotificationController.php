<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationInstanceResource;
use App\Repositories\NotificationInstanceRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('items_per_page', 10);
        $pageNumber = $request->input('page_number', 1);
        $skip = ($pageNumber - 1) * $perPage;

        $notifications = NotificationInstanceRepository::query()->where('recipient_id', auth()->id())->skip($skip)->take($perPage)->get();

        return $this->json($notifications ? 'Notifications found' : 'No notifications found', [
            'total_items' => count($notifications),
            'notifications' => NotificationInstanceResource::collection($notifications),
        ], $notifications ? 200 : 404);
    }
}
