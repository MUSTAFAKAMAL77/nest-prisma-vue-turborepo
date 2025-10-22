<?php

use App\Http\Controllers\AdsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// debugging routes
if (!app()->isProduction()) {
    Route::group(['prefix' => 'debug'], function () {
        // migration route
        Route::get('/migrate', function () {
            Artisan::call('migrate');
            dd('migrated!');
        });
        // migration with seed route
        Route::get('/migrate-seed', function () {
            Artisan::call('migrate --seed');
            dd('migrate and seed done!');
        });
        // migration fresh and migration with seed routes
        Route::get('/migrate-fresh-seed', function () {
            Artisan::call('migrate:fresh --seed');
            dd('migrate and seed done!');
        });

        // chach clear route
        Route::get('/optimize-clear', function () {
            Artisan::call('optimize:clear');
            dd('optimize:clear done!');
        });
        
        Route::get('/link-storage', function () {
    Artisan::call('storage:link');
});


    });
}

// frontend routes

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/post-by-date', [HomeController::class, 'search_blog'])->name('search.blog');
Route::get('/archive', [HomeController::class, 'archive'])->name('archive');
Route::get('/bangla-converter', [HomeController::class, 'bangla_converter'])->name('bangla_converter');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/latest-news', [HomeController::class, 'latest_news'])->name('latest_news');
Route::get('/populer-news', [HomeController::class, 'populer_news'])->name('populer_news');
Route::get('/topic/{tag_slug}', [HomeController::class, 'topic_news'])->name('topic_news');
Route::get('/poll', [HomeController::class, 'poll'])->name('poll');
Route::post('/poll-send', [HomeController::class, 'poll_send'])->name('poll_send');

Auth::routes(['verify' => true]);

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout');
    Route::get('/social-login/redirect/{provider}', 'redirectToProvider')->name('social.login');
    Route::get('/social-login/{provider}/callback', 'handleProviderCallback')->name('social.callback');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/resend', 'resend')->name('verification.resend');
    Route::get('/verification-confirmation/{code}','verification_confirmation')->name('email.verification.confirmation');
});


Route::controller(HomeController::class)->group(function () {

    Route::get('/email_change/callback', 'email_change_callback')->name('email_change.callback');
    Route::post('/password/reset/email/submit', 'reset_password_with_code')->name('password.update');
    Route::get('/users/login', 'login')->name('user.login');
    Route::get('/users/registration', 'registration')->name('user.registration');
    // Route::post('/users/login/cart', 'cart_login')->name('cart.login.submit');

    // policy  routes
    Route::get('/journalist-policy', 'journalistPolicy')->name('journalistPolicy');
    Route::get('/advertise-policy', 'advertisePolicy')->name('advertisePolicy');
    Route::get('/about-us', 'aboutUs')->name('aboutUs');
    Route::get('/terms-of-use', 'terms')->name('terms');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');
    
});


Route::resource('ads', AdsController::class);


// category
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/{category_slug}', 'listingByCategory')->name('posts.category');
});

// Subscribe
Route::post('/subscribers',[SubscribeController::class,'store'])->name('subscribers.store');

//change language
Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');

// site map
Route::get('/sitemap.xml', function () {
    return base_path('sitemap.xml');
});

// AIZ Uploader
Route::controller(AizUploadController::class)->group(function () {
    Route::get('/watermark_set', 'watermark_set');
    
    Route::post('/aiz-uploader', 'show_uploader');
    Route::post('/aiz-uploader/upload', 'upload');
    Route::get('/aiz-uploader/get_uploaded_files', 'get_uploaded_files');
    Route::post('/aiz-uploader/get_file_by_ids', 'get_preview_files');
    Route::get('/aiz-uploader/get_file_key/{name}', 'get_file_key');
    Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
});

// post details 
    
// Route::get('{country}',[OtherController::class,'addressWisePosts'])->name('post.searchWithAddress');
Route::get('location',[OtherController::class,'addressWisePosts'])->name('post.searchWithAddress');
// Route::get('{country}/{city}/{state}/{post_office}',[OtherController::class,'post_searchWithAddress'])->name('post.searchWithAddress');
 Route::post('/get-states',[OtherController::class,'getStates'])->name('p_get-state');
        Route::post('/get-cities',[OtherController::class,'getCities'])->name('p_get-city');
        Route::post('/get-upazilas',[OtherController::class,'getUpazilas'])->name('p_get-upazila');

Route::get('{category}/{id}',[OtherController::class,'post_details'])->name('post.details');
Route::post('ajax_loader',[OtherController::class,'ajax_loader'])->name('ajax_loader');

Route::get('print/{category}/{id}',[OtherController::class,'post_details_print'])->name('post.details_print');


