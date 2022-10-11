<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// all type of users have appelety to view all this routes ..

//front page
Route::get('/', 'HomeController@main_pge')->name('main_page');
Route::get('/terms/and/policy', 'HomeController@terms')->name('terms');

Route::get('make_cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
//    Artisan::call('route:clear');
    return 'success';
});

//for make phone check
Route::post('/code/send/check_phone', 'Admin\LoginController@send_check_phone')->name('phone.send.check_code');
Route::post('/code/resned/check_phone', 'Admin\LoginController@resned_check_phone')->name('phone.resned.check_code');
Route::post('/code/check_phone', 'Admin\LoginController@check_phone')->name('phone.check');

//for make email check
Route::post('/code/send/check_email', 'Admin\LoginController@send_check_email')->name('email.send.check_code');
Route::post('/code/resned/check_email', 'Admin\LoginController@resned_check_email')->name('email.resned.check_code');
Route::post('/code/check_email', 'Admin\LoginController@check_email')->name('email.check');

//for make parent phone check
Route::post('/code/send/check_parent', 'Admin\LoginController@send_check_parent_phone')->name('parent.send.check_code');
Route::post('/code/resned/check_parent', 'Admin\LoginController@resned_check_phone')->name('parent.resned.check_code');
Route::post('/code/check_parent', 'Admin\LoginController@check_phone')->name('parent.check');

Route::get('/teaching_members', 'HomeController@teaching_members')->name('front.teaching_members');

Route::get('/verify_email', 'Admin\LoginController@verify_email')->name('verify_email');
//next will be get
Route::post('/verify_account', 'Admin\LoginController@verify_account')->name('verify_account');
Route::get('/verify_account_get', 'Admin\LoginController@verify_account')->name('verify_account_get');
Route::post('/resend_verify', 'Admin\LoginController@resend_verify')->name('resend.verify.email');
Route::post('/teacher_verify_account', 'Admin\LoginController@teacher_verify_account')->name('teacher_verify_account');

//forget password
Route::get('/Forget-password', 'HomeController@forgetPassword')->name('Forget-password');
Route::post('reset_password_with_token', 'HomeController@resetPassword')->name('reset_password_with_token');
Route::post('changePasswordForRest', 'HomeController@changePasswordForRest')->name('changePasswordForRest');

//multi login routes
Route::post('/login_user', 'Admin\LoginController@login')->name('login_user');
Route::get('/get_subject_sign_up_levels/{id}', 'Front\EpisodesController@get_subject_levels');
Route::get('/{type?}/sign_up', 'Admin\LoginController@sign_up')->name('sign_up');
Route::get('/custom_sign_up/{episode_id}/{types}', 'Admin\LoginController@custom_sign_up')->name('custom_sign_up');
Route::post('/{type?}/store', 'Admin\LoginController@store')->name('store.new');
Route::post('/login_both', 'Admin\LoginController@login_both')->name('login_both');

Route::get('/login_both', function () {
    return view('front.login');
});
Route::post('/contact_us/store_new', 'Front\Contact_usController@store')->name('contact_us.store_new');

//parent routes
Route::get('/{student_id?}/student_parent', 'Admin\LoginController@student_parent')->name('student_parent');
Route::post('/store_parent', 'Admin\LoginController@store_parent')->name('store.parent');

//search
Route::resource('search_guest', 'Front\SearchController');

Route::resource('times', 'Front\EpisodesController');
Route::get('/times/{type}/{page_type}', 'Front\EpisodesController@show_before_register')->name('times.before.register');
Route::get('show_mix/{type}', 'Front\EpisodesController@show_mix')->name('front.show_mix');
Route::get('/times/search/episodes/{type}', 'Front\EpisodesController@search')->name('times.search.episodes');
Route::get('times/search/episodes/teacher/details/{id}', 'Front\EpisodesController@teacher_details')->name('front.teacher_details');


Route::get('/check', function () {
    Artisan::call('notification:send');
});
Route::get('sendEmail', 'Student\HomeController@sendEmail')->name('sendEmail');
Route::get('reverify/{id}/{code}/account', 'HomeController@reverify_account')->name('reverify.account');
Route::post('reverify_account/store/account', 'HomeController@reverify_account_store')->name('reverify_account.store');



Route::get('web/get_zones/{id}', 'HomeController@get_zones');
Route::get('web/get_cities/{id}', 'HomeController@get_cities');
Route::get('web/get_districts/{id}', 'HomeController@get_districts');

Route::get('web/get_subjects/{id}', 'HomeController@get_subjects');
Route::get('web/get_subject_levels/{id}', 'HomeController@get_subject_levels');

Route::get('/teacher/t_episodes/zoom/{id}/index', 'Teacher\episodes\EpisodeController@zoom')->name('t_episode.zoom');
Route::get('/teacher/t_episodes/zoom/meeting', 'Teacher\episodes\EpisodeController@zoom_meeting')->name('teacher.zoom_meeting');

Route::get('certificates/download/{id}', 'HomeController@download_certificate')->name('certificate.download');
Auth::routes();

Route::get('/clear-cache',function (){
   \Illuminate\Support\Facades\Artisan::call('cache:clear');
   \Illuminate\Support\Facades\Artisan::call('route:clear');
   \Illuminate\Support\Facades\Artisan::call('view:clear');
   \Illuminate\Support\Facades\Artisan::call('config:clear');

   return redirect()->back();
});




