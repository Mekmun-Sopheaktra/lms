<?php

namespace App\Listeners;

use App\Events\NotifyEvent;
use App\Repositories\CourseRepository;
use App\Repositories\NotificationInstanceRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;

class NotifyListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotifyEvent $event): void
    {
        $notification = NotificationRepository::query()->where('type', $event->type)->first();

        if (!$notification?->is_enabled) {
            return;
        }

        $course = CourseRepository::find(
            $event->metadata['course_id']
        );

        // Send notification to all enrolled users
        foreach ($course->enrollments as $enrollment) {
            $notificationText = str_replace('%course_title%', $enrollment->course->title, $notification->content);
            $notificationText = str_replace('%user_name%', $enrollment->user->name, $notificationText);

            // Create notification instance
            NotificationInstanceRepository::create([
                'notification_id' => $notification->id,
                'recipient_id' => $enrollment->user->id,
                'metadata' => json_encode($event->metadata),
                'content' => $notificationText,
            ]);
            $tokens = $enrollment->user->fcmDeviceTokens()->pluck('token')->toArray();

            try {
                $notificationService = new NotificationService;
                $notificationService->sends($tokens, $notificationText, $notificationText);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
