<?php

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Auth
Route::post('/login', 'Api\AuthController@login');
Route::get('/logout', 'Api\AuthController@logout');
Route::get('/account/delete', 'Api\AuthController@account_delete');
Route::post('/send/phone_check_code', 'Api\AuthController@send_phone_check_code');
Route::post('/check_phone', 'Api\AuthController@check_phone');

Route::post('/send/email_check_code', 'Api\AuthController@send_email_check_code');
Route::post('/check_email', 'Api\AuthController@check_email');

//forget password
Route::post('/forget_password/send_code', 'Api\AuthController@forget_password_send_code');
Route::post('/forget_password/check_code', 'Api\AuthController@forget_password_check_code');
Route::post('/forget_password/change_password', 'Api\AuthController@forget_password_change_password');

//Register
Route::post('/sign_up', 'Api\AuthController@sign_up');
Route::post('/check/second_step', 'Api\AuthController@check_second_step');


//Helpers
Route::get('/helpers/qualifications', 'Api\HelpersController@qualifications');
Route::get('/helpers/job_names', 'Api\HelpersController@job_names');
Route::get('/helpers/nationalities', 'Api\HelpersController@nationalities');
Route::get('/helpers/save_limits', 'Api\HelpersController@save_limits');
Route::get('/helpers/relations', 'Api\HelpersController@relations');
Route::get('/helpers/countries', 'Api\HelpersController@countries');
Route::get('/helpers/surah', 'Api\HelpersController@surah');
Route::get('/helpers/surah/aya_numbers/{surah_id}', 'Api\HelpersController@surah_aya_numbers');
Route::get('/helpers/zones/{id}', 'Api\HelpersController@zones');
Route::get('/helpers/cities/{id}', 'Api\HelpersController@cities');
Route::get('/helpers/districts/{id}', 'Api\HelpersController@districts');
Route::get('/helpers/levels/{type}', 'Api\HelpersController@levels');
Route::get('/helpers/episodes/{type}', 'Api\HelpersController@episodes');
Route::get('/helpers/episode/rate_questions', 'Api\HelpersController@episode_rate_questions');
Route::get('change/lang', 'Api\HelpersController@change_lang');

Route::get('config', 'Api\HelpersController@config');

Route::post('verify_account', 'Api\AuthController@verify_account');
Route::post('resend/verify/email', 'Api\AuthController@resend_verify_email');

//profile
Route::get('check/type', 'Api\Students\profileController@check_type');
Route::get('student/profile', 'Api\Students\profileController@profile');
Route::post('profile/update', 'Api\Students\profileController@update_profile');
Route::post('password/update', 'Api\Students\profileController@update_password');

//Zoom
// Get list of meetings.
Route::get('/meetings', 'Zoom\MeetingController@list');


// Create meeting room using topic, agenda, start_time.
Route::post('/meetings', 'Zoom\MeetingController@create');
// Get information of the meeting room by ID.
Route::get('/meetings/{id}', 'Zoom\MeetingController@get')->where('id', '[0-9]+');
Route::patch('/meetings/{id}', 'Zoom\MeetingController@update')->where('id', '[0-9]+');
Route::delete('/meetings/{id}', 'Zoom\MeetingController@delete')->where('id', '[0-9]+');


//Mail
Route::get('MailInbox', 'Api\Inbox\StudentInboxController@MailInbox');
Route::get('MailOutbox', 'Api\Inbox\StudentInboxController@MailOutbox');
Route::get('MailReply/{id}', 'Api\Inbox\StudentInboxController@MailReply');
Route::post('SendInbox', 'Api\Inbox\StudentInboxController@SendInbox');
Route::post('SendReply', 'Api\Inbox\StudentInboxController@SendReply');


Route::get('admins', 'Api\Inbox\StudentInboxController@admins');

//episode search
Route::get('student/episodes', 'Api\Students\EpisodeSearchController@Episodes');
Route::post('student/episodes-search', 'Api\Students\EpisodeSearchController@Search');
Route::post('student/episodes-SearchUnAuth', 'Api\Students\EpisodeSearchController@SearchUnAuth');
Route::get('student/episodes-join/{episode_id}', 'Api\Students\EpisodeSearchController@join');
Route::get('student/episodes-join_again/{episode_id}', 'Api\Students\EpisodeSearchController@join_again');
Route::get('student/cancel-join/{episode_id}', 'Api\Students\EpisodeSearchController@Cancel_join');

//home page
Route::get('/check_accounts', 'Api\Students\HomeController@check_accounts');
Route::post('/login_switch_account', 'Api\AuthController@login_switch_account');
Route::post('/firebase/cases/test', 'Api\AuthController@firebase_cases_test');
Route::get('student/home', 'Api\Students\HomeController@home');
Route::get('mail_count', 'Api\Students\HomeController@mail_count');


//Notification
Route::get('notification', 'Api\Students\NotificationController@Notification');
Route::get('notification-details/{id}', 'Api\Students\NotificationController@NotificationDetails');
Route::get('notification/make_read/{id}', 'Api\Students\NotificationController@make_read');
Route::get('notifications/unreaded/count', 'Api\Students\NotificationController@unreaded_count');

//certificates
Route::get('certificates', 'Api\Students\CertificateController@Certificates');

//reports
Route::get('student/report/daily_recitation', 'Api\Students\ReportsController@daily_recitation');
//my episodes
Route::get('my_episodes', 'Api\Students\EpisodesController@my_episodes');

Route::get('episode/{type}/turn', 'Api\Teacher\EpisodesController@next_turn');

Route::get('my_episode/info/{id}', 'Api\Students\EpisodesController@episode_info');
Route::get('teacher/my_episode/info/{id}', 'Api\Students\EpisodesController@episode_info');
Route::post('my_episode/far_learn/join', 'Api\Students\EpisodesController@far_learn_join');
Route::get('episode/my_turn', 'Api\Students\EpisodesController@my_turn');
Route::post('student/episode/check_rating', 'Api\Students\EpisodesController@check_rating');
Route::post('student/episode/rate', 'Api\Students\EpisodesController@rate_episode');



//teacher
//my episodes
//Route::get('teacher/my_episodes', 'Api\Teacher\EpisodesController@my_episodes');
Route::get('teacher/my_episode/info/{id}', 'Api\Teacher\EpisodesController@episode_info');
Route::get('teacher/episode/start', 'Api\Teacher\EpisodesController@start');
Route::get('teacher/episode/restart_again', 'Api\Teacher\EpisodesController@restart_again');
Route::get('teacher/episode/restart_again_after_time', 'Api\Teacher\EpisodesController@restart_again_after_time');
Route::get('teacher/episode/end_episode', 'Api\Teacher\EpisodesController@end_episode');
Route::post('teacher/make/student/absence', 'Api\Teacher\EpisodesController@make_absence');
Route::get('episode/far_learn_degrees', 'Api\Teacher\EpisodesController@far_learn_degrees');
Route::post('episode/make_far_learn_evaluate', 'Api\Teacher\EpisodesController@make_far_learn_evaluate');
Route::get('episode/student/degree', 'Api\Teacher\EpisodesController@student_degree');

Route::get('teacher/absence_requests', 'Api\Teacher\AbsenceRequestsController@index');
Route::post('teacher/absence_requests/store', 'Api\Teacher\AbsenceRequestsController@store');

Route::get('teacher/interview', 'Api\Teacher\InterviewsController@index');
Route::get('teacher/reports', 'Api\Teacher\ReportsController@index');
Route::post('teacher/change_time', 'Api\Teacher\EpisodesController@epo_time');
Route::post('teacher/episode/update_zoom_link', 'Api\Teacher\EpisodesController@update_zoom_link');
Route::post('teacher/episode/active_link_student', 'Api\Teacher\EpisodesController@active_link_student');
