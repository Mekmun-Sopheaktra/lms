<?php

use App\Http\Controllers\AccountActivationController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InstructorController as FrontendInstructorController;
use App\Http\Controllers\InstructorFavouriteController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::prefix('reset-password')->group(function () {
    Route::post('/', [ResetPasswordController::class, 'index']);
    Route::post('/validate', [ResetPasswordController::class, 'validateOtp']);
});

Route::prefix('guest')->group(function () {
    Route::post('/create', [GuestController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('account-activation')->group(function () {
        Route::get('/send-code', [AccountActivationController::class, 'sendActivationCode']);
        Route::post('/activate', [AccountActivationController::class, 'activateAccount']);
    });

    Route::patch('/update-password', [UserController::class, 'updatePassword']);
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/update', [UserController::class, 'update']);
        Route::delete('/delete', [UserController::class, 'delete']);
    });

    Route::get('/notifications', [NotificationController::class, 'index']);

    Route::get('/transactions', [PaymentController::class, 'index']);
    Route::get('/enroll_summary', [EnrollController::class, 'summary']);
    Route::get('/enrolled_courses', [EnrollController::class, 'index']);
    Route::get('/enroll/{course}', [EnrollController::class, 'initiateTransaction']);
    Route::get('/free/enroll/{course}', [EnrollController::class, 'freeEnrollment']);
    Route::get('/coupon/validate', [EnrollController::class, 'verifyCoupon']);
    Route::post('/review/{course}', [ReviewController::class, 'store']);
    Route::post('/view_content/{content}', [CourseController::class, 'viewContent']);

    Route::prefix('certificate')->group(function () {
        Route::get('/list', [CertificateController::class, 'index']);
        Route::get('/show/{course}', [CertificateController::class, 'show']);
    });

    // Exam
    Route::prefix('exam')->group(function () {
        Route::get('/start/{exam}', [ExamController::class, 'start']);
        Route::post('/submit/{examSession}', [ExamController::class, 'submit']);
    });

    // Quiz
    Route::prefix('quiz')->group(function () {
        Route::get('/start/{quiz}', [QuizController::class, 'start']);
        Route::post('/submit/{quizSession}', [QuizController::class, 'submit']);
    });

    // Admin APIs
    Route::prefix('admin')->group(function () {
        Route::prefix('category')->group(function () {
            Route::post('/create', [AdminCategoryController::class, 'store']);
            Route::post('/update/{category}', [AdminCategoryController::class, 'update']);
            Route::delete('/delete/{category}', [AdminCategoryController::class, 'destroy']);
        });

        Route::prefix('course')->group(function () {
            Route::post('/create', [AdminCourseController::class, 'store']);
            Route::post('/update/{course}', [AdminCourseController::class, 'update']);
            Route::delete('/delete/{course}', [AdminCourseController::class, 'destroy']);
        });

        Route::prefix('chapter')->group(function () {
            Route::post('/create', [ChapterController::class, 'store']);
            Route::post('/update/{chapter}', [ChapterController::class, 'update']);
            Route::delete('/delete/{chapter}', [ChapterController::class, 'destroy']);
        });

        Route::prefix('content')->group(function () {
            Route::post('/create', [ContentController::class, 'store']);
            Route::post('/update/{content}', [ContentController::class, 'update']);
            Route::delete('/delete/{content}', [ContentController::class, 'destroy']);
        });

        Route::prefix('contact')->group(function () {
            Route::get('/list', [AdminContactMessageController::class, 'index']);
            Route::delete('/delete/{contactMessage}', [AdminContactMessageController::class, 'destroy']);
        });

        Route::prefix('coupon')->group(function () {
            Route::get('/list', [CouponController::class, 'index']);
            Route::post('/create', [CouponController::class, 'store']);
            Route::post('/update/{content}', [CouponController::class, 'update']);
            Route::delete('/delete/{content}', [CouponController::class, 'destroy']);
        });

        Route::prefix('user')->group(function () {
            Route::get('/list', [AdminUserController::class, 'index']);
            Route::post('/create', [UserController::class, 'register']);
            Route::post('/update/{user}', [AdminUserController::class, 'update']);
            Route::delete('/delete/{user}', [AdminUserController::class, 'destroy']);
        });

        Route::prefix('instructor')->group(function () {
            Route::get('/list', [InstructorController::class, 'index']);
            Route::get('/show/{instructor}', [InstructorController::class, 'show']);
            Route::get('/me', [InstructorController::class, 'me']);
            Route::post('/create', [InstructorController::class, 'store']);
            Route::post('/update/{instructor}', [InstructorController::class, 'update']);
            Route::delete('/delete/{instructor}', [InstructorController::class, 'destroy']);
        });
    });
});

Route::get('/categories', [CategoryController::class, 'index']);

Route::prefix('course')->group(function () {
    Route::get('/list', [CourseController::class, 'index']);
    Route::get('/show/{course}', [CourseController::class, 'show']);
    Route::get('/get/progress/{course}', [CourseController::class, 'getProgress']);
    Route::post('/track/progress/{course}', [CourseController::class, 'progress']);
});

Route::prefix('instructor')->group(function () {
    Route::get('/list', [FrontendInstructorController::class, 'index']);
    Route::get('/show/{instructor}', [FrontendInstructorController::class, 'show']);
});

Route::prefix('favourite')->group(function () {
    Route::get('/list', [FavouriteController::class, 'index']);
    Route::post('/modify/{course}', [FavouriteController::class, 'modify']);
});

Route::prefix('favourite_instructor')->group(function () {
    Route::get('/list', [InstructorFavouriteController::class, 'index']);
    Route::post('/modify/{instructor}', [InstructorFavouriteController::class, 'modify']);
});

Route::prefix('pages')->group(function () {
    Route::get('/list', [PageController::class, 'index']);
    Route::get('/show/{slug}', [PageController::class, 'show']);
});

Route::prefix('contact')->group(function () {
    Route::post('/submit', [ContactMessageController::class, 'submit']);
});

Route::get('/master', [MasterController::class, 'index']);
