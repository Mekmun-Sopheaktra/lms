<?php

namespace Database\Seeders;

use App\Enum\NotificationTypeEnum;
use App\Repositories\NotificationRepository;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationRepository::create([
            'type' => NotificationTypeEnum::NewContentFromCourse,
            'is_enabled' => true,
            'content' => 'New content has been added to your enrolled course %course_title%'
        ]);

        NotificationRepository::create([
            'type' => NotificationTypeEnum::NewCourseFromInstructor,
            'is_enabled' => true,
            'content' => 'Your instructor has added a new course %course_title%'
        ]);
        NotificationRepository::create([
            'type' => NotificationTypeEnum::NewExamFromCourse,
            'is_enabled' => true,
            'content' => 'New Exam has added to your enrolled course %course_title%',
        ]);
        NotificationRepository::create([
            'type' => NotificationTypeEnum::NewQuizFromCourse,
            'is_enabled' => true,
            'content' => 'New Quiz has added to your enrolled course %course_title%',
        ]);
    }
}
