<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@main_pge')->name('main_page');
Route::get('/student/logout', 'Student\HomeController@logout')->name('student_logout');
Route::group(['middleware' => ['student'], 'prefix' => "student", 'namespace' => "Student"], function () {
    Route::get('home', 'HomeController@index')->name('student_home');
    Route::post('/change_colors', 'HomeController@change_colors')->name('student.change_colors');
    Route::get('/change_colors/reset', 'HomeController@change_colors_reset')->name('student.change_colors.reset');

    Route::resource('search', 'SearchController');
    Route::get('/search/episodes/search_epo', 'SearchController@store')->name('search.episodes');
    Route::get('/search/episode/join/{episode_id}', 'SearchController@join')->name('episode.join');
    Route::get('/search/episode/join_again/{episode_id}', 'SearchController@join_again')->name('episode.join_again');
    Route::get('/search/episode/leave/{episode_id}', 'SearchController@leave')->name('episode.leave');
    Route::get('/episode/teacher_info/{teacher_id}', 'SearchController@teacher_info')->name('student.episode.teacher_info');
    Route::get('/my_episodes', 'EpisodeController@my_episodes')->name('student.my_episodes');
    Route::get('/check/episode_start', 'EpisodeController@check_episode_start')->name('student.check.episode_start');
    Route::get('/check/order_num/{section_id}', 'EpisodeController@check_order_num')->name('student.check.order_num');
    Route::get('/my_episodes/degrees/{id}', 'EpisodeController@my_episode_degrees')->name('student.my_episode.degree');
    Route::get('/my_episodes/{id}', 'EpisodeController@show')->name('student_episodes.show');

    Route::get('/profile', 'HomeController@profile')->name('student.profile');
    Route::post('/profile', 'HomeController@update_profile')->name('student.profile.update');
    Route::get('/change_pass', 'HomeController@change_pass')->name('student.change_pass');
    Route::get('/profile/get_subjects/{id}', 'EpisodeController@get_subjects');
    Route::get('/profile/get_subject_levels/{id}', 'EpisodeController@get_subject_levels');
    Route::post('Store_Student_Question_episode', 'EpisodeController@Store_Student_Question_episode');
    Route::post('/fetch_data_to_rate/page/rate', 'EpisodeController@fetch_data_to_rate');

    Route::get('get_zones/{id}', 'HomeController@get_zones');
    Route::get('get_cities/{id}', 'HomeController@get_cities');
    Route::get('get_districts/{id}', 'HomeController@get_districts');

    Route::post('ChangePasswordStudent', 'HomeController@ChangePasswordStudent')->name('ChangePasswordStudent');
    Route::post('make_rate', 'EpisodeController@make_rate')->name('student.make_rate');
    Route::post('make_teacher_rate', 'EpisodeController@make_teacher_rate')->name('student.make_teacher_rate');

    //mails
    Route::get('/mail/inbox', 'MailsController@inbox')->name('mail.students.inbox');

    Route::get('/inbox/in', 'MailsController@MailInbox')->name('student.inbox.in');
    Route::get('/inbox/out', 'MailsController@MailOutbox')->name('student.inbox.out');
    Route::post('/send_inbox', 'MailsController@SendInbox')->name('student.post.mail');
    Route::get('student/inbox/reply/{id}', 'MailsController@MailReply')->name('student.inbox.reply');
    Route::post('send_reply', 'MailsController@SendReply')->name('student.send.reply');

    //student reports
    Route::get('reports/reciting_today', 'ReportsController@index')->name('student.reports.reciting_today');
    Route::post('reports/reciting_today', 'ReportsController@search')->name('student.reports.reciting_today.search');

    //certificates
    Route::get('/my_certificates', 'CertificatesController@index')->name('student.my_certificates');

});



