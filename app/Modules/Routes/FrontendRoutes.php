<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Policy\PolicyController;
use App\Http\Controllers\Quiz\QuizGivenController;

use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Seminer\SeminerController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Wishlist\WishlistController;
use App\Http\Controllers\Course\CourseEnrollController;
use App\Http\Controllers\Video\VideoController;
use App\Http\Controllers\LiveCourse\LiveCourseController;
use App\Modules\Controllers\Frontend\FrontendController;
use App\Modules\Controllers\Frontend\Auth\AuthController as BackendAuthController;


// Route::get('/', [FrontendController::class, 'HomePage'])->name('HomePage');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin-login', [BackendAuthController::class, 'LoginPage'])->name('LoginPage');
// Route::get('/register', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
// Route::get('/forgot-password', [AuthController::class, 'ForgotPassword'])->name('ForgotPassword');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_submit'])->name('login_sumbit');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-sumbit', [AuthController::class, 'register_sumbit'])->name('register_sumbit');

Route::get('/forgot-password',  [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordSubmit'])->name('forgot.password.submit');
Route::get('/verify-otp',       [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/verify-otp',      [AuthController::class, 'verifyOtpSubmit'])->name('verify.otp.submit');
Route::get('/reset-password',   [AuthController::class, 'resetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password',  [AuthController::class, 'resetPasswordSubmit'])->name('reset.password.submit');

Route::post('logout', [AuthController::class, 'logout_submit'])->name('logout');

// Website Routes
Route::get('/', [HomeController::class, 'index'])->name("website");
Route::get('/about', [AboutController::class, 'index'])->name("about");
Route::get('/contact', [ContactController::class, 'contact'])->name("contact");
Route::post('/contact', [ContactController::class, 'store'])->name("contact_store");
Route::get('/gallery', [GalleryController::class, 'gallery'])->name("gallery");
Route::get('/videos', [VideoController::class, 'index'])->name("videos");

Route::get('/teacher/{teacher_name}/{slug}', [TeacherController::class, 'teacher_details'])->name("teacher.details");
Route::get('/trainers', [TeacherController::class, 'trainer_details'])->name("trainer.details");


Route::get('/courses', [CourseController::class, 'courses'])->name("courses");

// Live Course Routes
Route::get('/live-courses', [LiveCourseController::class, 'index'])->name('live_courses');
Route::get('/live-course/{slug}', [LiveCourseController::class, 'details'])->name('live_course_details');
Route::get('/live-course/{slug}/enroll', [LiveCourseController::class, 'enroll'])->name('live_course_enroll');
Route::post('/live-course/{slug}/enroll', [LiveCourseController::class, 'enroll_submit'])->name('live_course_enroll_submit');
Route::get('/live-course/{slug}/enroll/success', [LiveCourseController::class, 'enroll_success'])->name('live_course_enroll_success');

// Live Course SSLCommerz callbacks (CSRF exempt — see VerifyCsrfToken)
Route::post('/live-course-payment/success', [LiveCourseController::class, 'ssl_success'])->name('live_course_ssl_success');
Route::post('/live-course-payment/failure', [LiveCourseController::class, 'ssl_failure'])->name('live_course_ssl_failure');
Route::post('/live-course-payment/cancel',  [LiveCourseController::class, 'ssl_cancel'])->name('live_course_ssl_cancel');
Route::post('/live-course-payment/ipn',     [LiveCourseController::class, 'ssl_ipn'])->name('live_course_ssl_ipn');

Route::get('/course/{slug}', [CourseController::class, 'course_details'])->name("course_details");

Route::get('/blog', [BlogController::class, 'blog'])->name("blog");
Route::get('/blog/{slug}', [BlogController::class, 'blog_details'])->name("blog_details");
Route::post('/subscribed', [BlogController::class, 'subscribe'])->name("blog.subscribe");

Route::get('/seminar', [SeminerController::class, 'seminar'])->name("seminar");
Route::get('/all-seminers', [SeminerController::class, 'seminar'])->name("all-seminers");
Route::get('/seminar/details/{id}', [SeminerController::class, 'seminar_details'])->name("seminar.details");
Route::post('/seminar-registration', [SeminerController::class, 'registerSeminar'])->name("registerSeminar");
Route::post('/seminar-subscribe', [SeminerController::class, 'subscribe'])->name("seminar.subscribe");
Route::post('/seminar-review', [SeminerController::class, 'review'])->name("seminar.review");
Route::post('/seminar-review-reply/{id}', [SeminerController::class, 'review_reply'])->name("seminar.review.reply");

Route::get('/stories', [HomeController::class, 'stories'])->name("stories");

// WhatsApp Group
Route::get('/whatsapp-group/{slug?}', function ($slug = null) {
    $course = $slug
        ? \App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model::active()->where('slug', $slug)->first()
        : null;
    return view('frontend.pages.extra.whatsapp_group', compact('course'));
})->name('whatsapp.group');

// Policy Routes
Route::get('/privacy-policy', [PolicyController::class, 'privacy_policy'])->name("privacy.policy");
Route::get('/refund-policy', [PolicyController::class, 'refund_policy'])->name("refund.policy");
Route::get('/cookies-policy', [PolicyController::class, 'cookies_policy'])->name("cookies.policy");
Route::get('/terms-policy', [PolicyController::class, 'terms_policy'])->name("terms.policy");
Route::get('/sitemap', [PolicyController::class, 'sitemap'])->name("sitemap.policy");

// SSL Commerz callbacks (CSRF exempt — see VerifyCsrfToken)
Route::post('sslcommerz/success', [PaymentController::class, 'success'])->name('sslc.success');
Route::post('sslcommerz/failure', [PaymentController::class, 'failure'])->name('sslc.failure');
Route::post('sslcommerz/cancel',  [PaymentController::class, 'cancel'])->name('sslc.cancel');
Route::post('sslcommerz/ipn',     [PaymentController::class, 'ipn'])->name('sslc.ipn');

// Payment success page (GET, shown after redirect)
Route::get('payment/success/{slug}', [PaymentController::class, 'payment_success'])->name('payment.success');

// Legacy enroll route — redirects to course detail
Route::get('/course/enroll/{slug}', [CourseEnrollController::class, 'course_enroll'])->name("course_enroll");
// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Course checkout — directly initiates SSL payment
    Route::post('/course/checkout/{slug}', [CourseEnrollController::class, 'checkout'])->name('course.checkout');

    // User Course Routes
    Route::get('/my-course', [CourseController::class, 'myCourse'])->name("myCourse");
    Route::get('/my-course/{slug}', [CourseController::class, 'myCourseDetails'])->name("mycourse_details");
    Route::get('/my-live-courses', [LiveCourseController::class, 'myLiveCourses'])->name("myLiveCourses");
    Route::get('/quiz/{quiz_id}', [QuizGivenController::class, 'showQuiz'])->name('quiz.show');
    Route::post('/quiz/submit', [QuizGivenController::class, 'submitQuiz'])->name('quiz.submit');
    Route::post('/course_completion', [QuizGivenController::class, 'course_completion'])->name('course_completion');

    Route::post('/clear-return-to-module', function () {
        request()->session()->forget('return_to_module');
        return response()->noContent();
    })->name('clear.return.to.module');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'profileUpdate'])->name('update_profile');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [ProfileController::class, 'changePasswordUpdate'])->name('change.password.update');


    // Wishlist Routes
    Route::post('/wishlist/add/{course}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove/{course}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
});
