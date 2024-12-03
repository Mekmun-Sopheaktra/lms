<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Http\Resources\PaymentGatewayResource;
use App\Models\PaymentGateway;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $mostValuableCoursePrice = (int) CourseRepository::query()->orderBy('price', 'desc')->first()?->price;
        $setting = SettingRepository::query()->get()->first();

        return $this->json('Master info found', [
            'master' => [
                'name' => config('app.name'),
                'logo' => $setting->logoPath,
                'favicon' => $setting->faviconPath,
                'footer' => $setting->footerPath,
                'currency_symbol' => config('app.currency_symbol'),
                'currency' => config('app.currency'),
                'currency_position' => $setting->currency_position,
                'timezone' => config('app.timezone'),
                'credit_text' => $setting->footer_text,
                'min_course_price' => 0,
                'max_course_price' => 0 == $mostValuableCoursePrice ? 1_000 : $mostValuableCoursePrice,
                'payment_methods' => PaymentGatewayResource::collection(PaymentGateway::query()->where('is_active', '=', true)->get()),
                'pages' => PageResource::collection(PageRepository::query()->get()),
                'total_courses' =>  CourseRepository::getAll()->count(),
                'total_instructors' =>  InstructorRepository::getAll()->count(),
                'total_enrollments' =>  EnrollmentRepository::getAll()->count(),
                'footer_description' => config('footer.footer_description'),
                'footer_contact' => config('footer.footer_contact'),
                'footer_email' => config('footer.footer_email'),
                'footer_social_icons' => config('footer.footer_social_icons'),
                'footer_apple_link' => config('footer.footer_apple_link'),
                'footer_google_link' => config('footer.footer_google_link'),
            ],
        ]);
    }

    public function checkDeviceAndRedirect(Request $request)
    {
        $userAgent = $request->header('User-Agent');

        if (stripos($userAgent, 'Android') !== false) {
            return redirect('https://play.google.com/store');
        }

        if (stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'iPad') !== false) {
            return redirect('https://www.apple.com/app-store');
        }

        return redirect('/');
    }
}
