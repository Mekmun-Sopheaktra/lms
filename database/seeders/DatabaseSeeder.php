<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
            NotificationSeeder::class,
            PaymentGatewaySeeder::class
        ]);

        if (app()->isLocal()) {
            $this->call([
                CategorySeeder::class,
                InstructorSeeder::class,
                EducationSeeder::class,
                ExperienceSeeder::class,
                CourseSeeder::class,
                ChapterSeeder::class,
                ContentSeeder::class,
                ReviewSeeder::class,
                CouponSeeder::class,
                // EnrollmentSeeder::class,
                ArticleSeeder::class,
                ContactMessageSeeder::class,
                // TransactionSeeder::class,
                PageSeeder::class,
                ExamSeeder::class,
                QuizSeeder::class,
                QuestionSeeder::class,
            ]);
        }
    }
}
