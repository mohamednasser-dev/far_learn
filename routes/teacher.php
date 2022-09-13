<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@main_pge')->name('main_page');
Route::get('/teacher/logout', 'Teacher\HomeController@logout')->name('teacher_logout');

Route::post('/teacher/episode/create/meetings/{id}', 'Zoom\MeetingController@teacher_update_zoom_url')->name('teacher.create.web.meeting');

Route::group(['middleware' => ['teacher'], 'prefix' => "teacher", 'namespace' => "Teacher"], function () {
    Route::get('home', 'HomeController@index')->name('teacher.home');

    // profile
    Route::get('profile', 'HomeController@profile')->name('teacher.profile');
    Route::post('/profile', 'HomeController@update_profile')->name('teacher.profile');
    Route::get('/change_pass', 'HomeController@change_pass')->name('teacher.change_pass');
    Route::post('change_pass', 'HomeController@ChangePasswordTeacher')->name('teacher.store.change_pass');

    // episodes
    Route::resource('t_episodes', 'episodes\EpisodeController');
    Route::get('t_episodes/epo_time/{section_id}/{type}', 'episodes\EpisodeController@epo_time')->name('t_episodes.epo_time');
    Route::get('/check/students/{episode_id}', 'episodes\EpisodeController@check_students')->name('teacher.check.students');
    Route::post('stud/make_come', 'episodes\EpisodeController@make_come');
    Route::post('t_episodes/make_link_all', 'episodes\EpisodeController@make_link_all');
    Route::post('t_episodes/restart', 'episodes\EpisodeController@restart_episode')->name('t_episode.epo.restart');
    Route::post('t_episodes/restart_again', 'episodes\EpisodeController@restart_again_episode')->name('t_episode.epo.restart_again');
    Route::get('t_episodes/update_link/{id}', 'episodes\EpisodeController@update_link')->name('t_episodes.update_link');
    Route::get('t_episodes/end_epo/{section_id}', 'episodes\EpisodeController@end_epo')->name('teacher.epo.end');
    Route::get('t_episodes/page/blank', 'episodes\EpisodeController@blank_page')->name('teacher.epo.blank_page');

    Route::post('t_episodes/make_evaluate', 'episodes\EpisodeController@make_evaluate')->name('t_episodes.make_evaluate');
    Route::post('t_episodes/make_far_learn_evaluate', 'episodes\EpisodeController@make_far_learn_evaluate')->name('t_episodes.make_far_learn_evaluate');
    Route::get('t_episodes/delete_evaluate/{id}', 'episodes\EpisodeController@delete_evaluate')->name('t_episodes.delete_evaluate');
    Route::get('/t_episodes/student/details/{id}/{episode_id}', 'episodes\EpisodeController@get_student_info')->name('t_episode.student_info');
    Route::get('/t_episodes/students/{epo_id}', 'episodes\EpisodeController@epo_students')->name('teacher.epo.students');
    Route::get('/t_episodes/students/degrees/{stud_id}/{epo_id}', 'episodes\EpisodeController@epo_student_degrees')->name('teacher.epo.student.degrees');
    Route::post('/t_episodes/edit_link', 'episodes\EpisodeController@edit_link')->name('t_episode.edit_link');
    Route::get('/my_meetings/interview', 'InterviewsController@index')->name('teacher.my_meetings');

    Route::get('/t_episodes/plan/degree/{type}/{student_id}/{plan_id}/{section_id}/{total}/{subject_id}', 'episodes\EpisodeController@give_degree')->name('t_episodes.plan.degree');
    Route::get('/teacher/new_epo', 'episodes\EpisodeController@new_epo')->name('teacher.new_epo');
    Route::get('/teacher/episode/next_turn/{section_id}', 'episodes\EpisodeController@next_turn')->name('t_episode.next_turn');
    Route::get('/teacher/episode/previous_turn/{section_id}', 'episodes\EpisodeController@previous_turn')->name('t_episode.previous_turn');

    //mails
    Route::get('/mail/inbox', 'MailsController@inbox')->name('mail.teacher.inbox');

    //zoom room
    Route::get('/interviews/zoom_room/{id}', 'InterviewsController@zoom_room')->name('teachers.zoom_room.interviews');
    Route::get('/interviews/show/zoom/{id}', 'InterviewsController@zoom')->name('teachers.zoom.interviews');
//



    Route::get('teacher/inbox/in', 'MailsController@MailInbox')->name('teacher.inbox.in');
    Route::get('teacher/inbox/out', 'MailsController@MailOutbox')->name('teacher.inbox.out');
    Route::post('teacher/send_inbox', 'MailsController@SendInbox')->name('teacher.post.mail');
    Route::get('teacher/inbox/reply/{id}', 'MailsController@MailReply')->name('teacher.inbox.reply');
    Route::post('send_reply', 'MailsController@SendReply')->name('teacher.send.reply');
    //teacher requests
    Route::get('request/absence', 'RequestsController@index')->name('teacher.request.absence');
    Route::post('request/absence/store', 'RequestsController@store')->name('teacher_request.absence.store');

    //teacher reports
    Route::get('reports/reciting_today', 'ReportsController@index')->name('teacher.reports.reciting_today');
    Route::post('reports/reciting_today', 'ReportsController@search')->name('teacher.reports.reciting_today.search');

});



