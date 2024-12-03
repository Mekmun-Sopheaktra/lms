<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebAdmin\LoginController;
use App\Http\Controllers\WebAdmin\CategoryController;
use App\Http\Controllers\WebAdmin\ChapterController;
use App\Http\Controllers\WebAdmin\CouponController;
use App\Http\Controllers\WebAdmin\CourseController;
use App\Http\Controllers\WebAdmin\DashboardController;
use App\Http\Controllers\WebAdmin\EnrollmentController;
use App\Http\Controllers\WebAdmin\ExamController;
use App\Http\Controllers\WebAdmin\InstructorController;
use App\Http\Controllers\WebAdmin\NotificationController;
use App\Http\Controllers\WebAdmin\PageController;
use App\Http\Controllers\WebAdmin\PaymentGatewayController;
use App\Http\Controllers\WebAdmin\QuizController;
use App\Http\Controllers\WebAdmin\ReviewController;
use App\Http\Controllers\WebAdmin\SettingController;
use App\Http\Controllers\WebAdmin\StorageLinkController;
use App\Http\Controllers\WebAdmin\TransactionController;
use App\Http\Controllers\WebAdmin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');
});

Route::middleware(['auth:web', 'adminauth'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::controller(CategoryController::class)->prefix('category')->group(function () {
            Route::get('/list', 'index')->name('category.index');
            Route::get('/create', 'create')->name('category.create');
            Route::post('/store', 'store')->name('category.store');
            Route::get('/edit/{category}', 'edit')->name('category.edit');
            Route::put('/update/{category}', 'update')->name('category.update');
            Route::get('/delete/{category}', 'delete')->name('category.destroy');
            Route::get('/restore/{id}', 'restore')->name('category.restore');
        });

        Route::controller(CourseController::class)->prefix('course')->group(function () {
            Route::get('/list', 'index')->name('course.index');
            Route::get('/create', 'create')->name('course.create');
            Route::post('/store', 'store')->name('course.store');
            Route::get('/edit/{course}', 'edit')->name('course.edit');
            Route::put('/update/{course}', 'update')->name('course.update');
            Route::get('/delete/{course}', 'delete')->name('course.destroy');
            Route::get('/restore/{id}', 'restore')->name('course.restore');
            Route::get('/free/{course}', 'freeCourse')->name('course.free');
        });

        Route::controller(ChapterController::class)->prefix('chapter')->group(function () {
            Route::get('/select_course', 'selectCourse')->name('chapter.select_course');
            Route::get('/list/{course}', 'index')->name('chapter.index');
            Route::get('/create/{course}', 'create')->name('chapter.create');
            Route::post('/store', 'store')->name('chapter.store');
            Route::get('/edit/{chapter}', 'edit')->name('chapter.edit');
            Route::put('/update/{chapter}', 'update')->name('chapter.update');
            Route::get('/delete/{chapter}', 'delete')->name('chapter.destroy');
        });

        Route::controller(ExamController::class)->prefix('exam')->group(function () {
            Route::get('/select_course', 'selectCourse')->name('exam.select_course');
            Route::get('/list/{course}', 'index')->name('exam.index');
            Route::get('/create/{course}', 'create')->name('exam.create');
            Route::post('/store', 'store')->name('exam.store');
            Route::get('/edit/{exam}', 'edit')->name('exam.edit');
            Route::put('/update/{exam}', 'update')->name('exam.update');
            Route::get('/delete/{exam}', 'delete')->name('exam.destroy');
        });

        Route::controller(QuizController::class)->prefix('quiz')->group(function () {
            Route::get('/select_course', 'selectCourse')->name('quiz.select_course');
            Route::get('/list/{course}', 'index')->name('quiz.index');
            Route::get('/create/{course}', 'create')->name('quiz.create');
            Route::post('/store', 'store')->name('quiz.store');
            Route::get('/edit/{quiz}', 'edit')->name('quiz.edit');
            Route::put('/update/{quiz}', 'update')->name('quiz.update');
            Route::get('/delete/{quiz}', 'delete')->name('quiz.destroy');
        });

        Route::controller(CouponController::class)->prefix('coupon')->group(function () {
            Route::get('/list', 'index')->name('coupon.index');
            Route::get('/create', 'create')->name('coupon.create');
            Route::post('/store', 'store')->name('coupon.store');
            Route::get('/edit/{coupon}', 'edit')->name('coupon.edit');
            Route::put('/update/{coupon}', 'update')->name('coupon.update');
            Route::get('/delete/{coupon}', 'delete')->name('coupon.destroy');
        });

        Route::controller(EnrollmentController::class)->prefix('enrollment')->group(function () {
            Route::get('/list', 'index')->name('enrollment.index');
            Route::get('/delete/{enrollment}', 'delete')->name('enrollment.destroy');
            Route::get('/restore/{id}', 'restore')->name('enrollment.restore');
        });

        Route::controller(ReviewController::class)->prefix('review')->group(function () {
            Route::get('/list', 'index')->name('review.index');
            Route::get('/delete/{review}', 'delete')->name('review.destroy');
        });

        Route::controller(InstructorController::class)->prefix('instructor')->group(function () {
            Route::get('/list', 'index')->name('instructor.index');
            Route::get('/featured', 'featured')->name('instructor.featured');
            Route::get('/promote/{user}', 'promote')->name('instructor.promote');
            Route::post('/migrate/{user}', 'migrate')->name('instructor.migrate');
            Route::get('/create', 'create')->name('instructor.create');
            Route::post('/store', 'store')->name('instructor.store');
            Route::get('/edit/{instructor}', 'edit')->name('instructor.edit');
            Route::put('/update/{instructor}', 'update')->name('instructor.update');
            Route::get('/delete/{instructor}', 'delete')->name('instructor.destroy');
            Route::get('/restore/{id}', 'restore')->name('instructor.restore');
        });

        Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
            Route::get('/list', 'index')->name('transaction.index');
        });

        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::get('/list', 'index')->name('user.index');
            Route::get('/create', 'create')->name('user.create');
            Route::post('/store', 'store')->name('user.store');
            Route::get('/edit/{user}', 'edit')->name('user.edit');
            Route::put('/update/{user}', 'update')->name('user.update');
            Route::get('/delete/{user}', 'delete')->name('user.destroy');
            Route::get('/restore/{id}', 'restore')->name('user.restore');
        });

        Route::get('/admin/list', [UserController::class, 'admin'])->name('admin.index');

        Route::controller(PageController::class)->prefix('page')->group(function () {
            Route::get('/list', 'index')->name('page.index');
            Route::get('/edit/{page}', 'edit')->name('page.edit');
            Route::put('/update/{page}', 'update')->name('page.update');
        });

        Route::controller(SettingController::class)->prefix('setting')->group(function () {
            Route::get('/', 'index')->name('setting.index');
            Route::put('/update', 'update')->name('setting.update');
        });

        Route::controller(PaymentGatewayController::class)->prefix('payment_gateway')->group(function () {
            Route::get('/', 'index')->name('payment_gateway.index');
            Route::put('/update/{paymentGateway}', 'update')->name('payment_gateway.update');
        });

        Route::controller(NotificationController::class)->prefix('notification')->group(function () {
            Route::get('/list', 'index')->name('notification.index');
            Route::get('/edit/{notification}', 'edit')->name('notification.edit');
            Route::put('/update/{notification}', 'update')->name('notification.update');
        });

        Route::get('/link/storage', [StorageLinkController::class, 'linkStorage'])->name('link.storage');
    });
});

Route::get('/payment/{identifier}', [EnrollController::class, 'paymentView'])->name('payment');

// Paypal
Route::get('paypal/payment/success/{identifier}', [PaymentController::class, 'paypalPaymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaymentController::class, 'paypalPaymentCancel'])->name('paypal.payment.cancel');

// Stripe
Route::get('stripe/payment/success/{identifier}', [PaymentController::class, 'stripePaymentSuccess'])->name('stripe.payment.success');
Route::get('stripe/payment/cancel', [PaymentController::class, 'stripePaymentCancel'])->name('stripe.payment.cancel');

// AamarPay
Route::post('aamarpay/payment/success', [PaymentController::class, 'aamarpayPaymentSuccess'])->name('aamrpay.payment.success');
Route::post('aamarpay/payment/fail', [PaymentController::class, 'aamarpayPaymentFail'])->name('aamrpay.payment.fail');
Route::get('aamarpay/payment/cancel', [PaymentController::class, 'aamarpayPaymentCancel'])->name('aamrpay.payment.cancel');


// razorpay
Route::get('razorpay/payment/success/{identifier}', [PaymentController::class, 'razorPaySuccess'])->name('razorpay.payment.success');
Route::get('razorpay/payment/fail', [PaymentController::class, 'razorpayPaymentFail'])->name('razorpay.payment.fail');

Route::get('/download_app', [MasterController::class, 'checkDeviceAndRedirect'])->name('download_app');

// downloadable certificate url
Route::controller(CertificateController::class)->group(function () {
    Route::get('/download/certificate/{incodeData}', 'downloadCertificate')->name('download.certificate');
});


// this is proxy url
Route::get('/{any}', fn() => view('website'))->name('website')->where('any', '.*');
