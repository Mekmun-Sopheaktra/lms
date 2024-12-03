<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\UserRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Crypt;

class CertificateController extends Controller
{
    public function index()
    {
        $courses = CourseRepository::query()
            ->where('certificate_available', '=', true)
            ->whereHas('enrollments', function ($query) {
                return $query->where('user_id',  auth()->id());
            })
            ->get();

        return $this->json('Certificates found', [
            'certificate_courses' => CourseResource::collection($courses),
        ]);
    }

    public function show(Course $course)
    {
        $enrollment = EnrollmentRepository::query()
            ->where('course_id', '=', $course->id)
            ->where('user_id', '=', auth()->user()->id)
            ->first();

        if (!$enrollment) {
            return $this->json('Enrollment required', null, 403);
        }

        if (!$enrollment->course->certificate_available) {
            return $this->json('Certificate not available', null, 404);
        }

        EnrollmentRepository::update($enrollment, ['is_certificate_downloaded' => true]);

        $url = [
            'user_id' => auth()->user()->id,
            'enrollment' => $enrollment->course->title,
        ];

        $encryptData = encrypt($url);
        $encodedUrl = urlencode($encryptData);

        return $this->json('certificate url', [
            'url' => route('download.certificate', $encodedUrl)
        ]);
    }

    public function downloadCertificate($encodeData)
    {
        try {
            $bycryptData = decrypt($encodeData);;
            $userId = $bycryptData['user_id'];
            $user = UserRepository::query()->where('id', $userId)->first();

            return $this->generatePdf(
                $user->name,
                $bycryptData['enrollment'],
                UserRepository::find(1)->name,
            );
        } catch (Exception $th) {
            return $this->json('invalid course or users', [], 422);
        }
    }

    public function generatePdf($studentName, $courseTitle, $adminName)
    {
        $pdf = Pdf::loadView('enrollment.certificate', [
            'studentName' => $studentName,
            'courseTitle' => $courseTitle,
            'adminName' => $adminName,
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download("$studentName" . ".pdf");
    }
}
