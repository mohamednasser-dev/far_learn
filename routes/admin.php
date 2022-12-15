<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@main_pge')->name('main_page');
Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

//super admin
Route::get('/super_admin/login', 'SuperAdmin\HomeController@login')->name('super_admin.login');
Route::post('/super_admin/login/store', 'SuperAdmin\HomeController@login_store')->name('super_admin.login.store');



Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::post('/change_colors', 'Admin\HomeController@change_colors')->name('admin.change_colors');
    Route::get('/change_colors/reset', 'Admin\HomeController@change_colors_reset')->name('admin.change_colors.reset');
    Route::get('/tenants', 'SuperAdmin\HomeController@tenants')->name('tenants');
    Route::post('/tenants/store/new', 'SuperAdmin\HomeController@store')->name('tenants.store');
    Route::post('/tenants/update', 'SuperAdmin\HomeController@update')->name('tenants.update');
    Route::get('/tenants/{id}/delete', 'SuperAdmin\HomeController@delete')->name('tenants.delete');
    Route::get('/notifications', 'Admin\HomeController@notifications')->name('notifications');
    Route::get('/notifications/change_readed/{id}', 'Admin\HomeController@notification_change_readed')->name('notification.change_readed');
    Route::get('mail/incoming', 'Admin\MailController@incoming')->name('mail.incoming');
    Route::get('mail/outgoing', 'Admin\MailController@outgoing')->name('mail.outgoing');
    Route::get('mail/inbox', 'Admin\MailController@inbox')->name('mail.inbox');


    Route::get('inbox/in', 'Admin\MailController@MailInbox')->name('inbox.in');
    Route::get('inbox/out', 'Admin\MailController@MailOutbox')->name('inbox.out');
    Route::get('inbox/reply/{id}', 'Admin\MailController@MailReply')->name('inbox.reply');
    Route::post('send_inbox', 'Admin\MailController@SendInbox');
    Route::post('send_reply', 'Admin\MailController@SendReply')->name('send.reply');

    Route::group(['prefix' => "episode", 'namespace' => 'Admin\episodes'], function () {
        Route::get('index', 'EpisodeController@index')->name('episode.index');
        Route::get('students/{id}', 'EpisodeController@students')->name('episode.students');
        Route::get('show/{type}', 'EpisodeController@index')->name('episode.show.type');
        Route::post('update', 'EpisodeController@update')->name('episode.update');
        Route::post('place/teacher', 'EpisodeController@place_teacher')->name('episode.place.teacher');
        Route::post('place/students', 'EpisodeController@place_students')->name('episode.place.students');
        Route::post('place/teachers', 'EpisodeController@place_teachers')->name('episode.place.teachers');
        Route::get('details/{id}', 'EpisodeController@details')->name('episode.details');
        Route::get('zoom_settings/{id}', 'EpisodeController@zoom_settings')->name('episode.zoom_settings');
        Route::post('/episode/change_status', 'EpisodeController@change_status')->name('episode.change_status');

       //certificates

        Route::get('/certificates/create', 'CertificatesController@certificate')->name('episode.create.certificates');

        Route::post('certificates', 'CertificatesController@export_certificate')->name('episode.export.certificates');
        Route::get('details/certificates/{id}', 'CertificatesController@episode_certificates')->name('episode.details.certificates');
        Route::get('details/certificates/create/{student_id}/{episode_id}', 'CertificatesController@create_certificate')->name('certificates.create');


        Route::get('days/{id}', 'EpisodeController@episode_days')->name('episode.days');
        Route::post('week/store', 'EpisodeController@store_week')->name('week.store');

        Route::post('course_date/update', 'EpisodeController@update_course_date')->name('course_date.update');
        Route::post('course_date/store', 'EpisodeController@store_course_day')->name('course_date.store');
        Route::get('course_date/delete/{id}', 'EpisodeController@delete_course_day')->name('course_date.delete');

        Route::get('edit/{id}', 'EpisodeController@edit')->name('episode.edit');
        Route::get('index_create_mogmaa', 'EpisodeController@index_create_mogmaa')->name('episode.index_create_mogmaa');
//            Route::get('store', 'EpisodeController@store')->name('episode.store');
        Route::get('store_dorr/{type}', 'EpisodeController@store_dorr')->name('episode.store_dorr');
        Route::get('create', 'EpisodeController@create')->name('episode.create');
        Route::get('create_mqraa', 'EpisodeController@create_mqraa')->name('episode.create_mqraa');
        Route::get('create_dorr', 'EpisodeController@create_dorr')->name('episode.create_dorr');
        Route::get('delete/{id}', 'EpisodeController@destroy')->name('episode.delete');

        Route::get('conect_subject_plan', 'EpisodeController@conect_subject_plan')->name('episode.conect_subject_plan');
        Route::post('/conect_subject_plan/store', 'EpisodeController@store_plan_new')->name('conect_subject_plan.store');
        Route::post('/conect_subject_plan/update', 'EpisodeController@update_plan_new')->name('conect_subject_plan.update');
        Route::get('show_plan/{id}', 'EpisodeController@show_plan')->name('conect_subject_plan.show_plan');

        Route::post('episode/create/meetings/{id}', 'Zoom\MeetingController@web_create')->name('create.web.meeting');
    });


    Route::get('episode/long_episodes', 'Admin\MailController@long_episodes')->name('episode.long_episodes');
    Route::get('episode/long_episodes/{id}/{status}', 'Admin\MailController@change_status_long_episodes')->name('episode.change_status_long_episodes');

    //country
    Route::get('subjects/ErrorType/far_episode', 'Admin\episodes\ErrorTypeController@far_episode_ErrorType_index')->name('far_episode_ErrorType.index');
    Route::post('subjects/ErrorType/far_episode', 'Admin\episodes\ErrorTypeController@far_episode_ErrorType_store')->name('far_episode_ErrorType.store');
    Route::post('subjects/ErrorType/far_episode/update', 'Admin\episodes\ErrorTypeController@far_episode_ErrorType_update')->name('far_episode_ErrorType.update');
    Route::get('subjects/ErrorType/far_episode/delete/{id}', 'Admin\episodes\ErrorTypeController@far_episode_ErrorType_delete')->name('far_episode_ErrorType.delete');

    //restart epo
    Route::get('far_episode/restart/episode/requests', 'Admin\episodes\EpisodeController@restart_episode')->name('far_episode.restart.epo');
    Route::get('far_episode/restart_epo/change_status/{type}/{id}', 'Admin\episodes\EpisodeController@far_learn_restart_epo_change_status')->name('far_learn.restart.change_status');


    Route::get('far_episode/show/{id}', 'Admin\episodes\EpisodeController@show')->name('far_episode.show');
    Route::get('far_episode/join_request', 'Admin\episodes\EpisodeController@join_request')->name('far_episode.join_request');
    Route::get('far_episode/reject_join_request', 'Admin\episodes\EpisodeController@reject_join_request')->name('far_episode.reject_join_request');
    Route::get('far_episode/change_status/{type}/{id}', 'Admin\episodes\EpisodeController@far_learn_change_status')->name('far_learn.change_status');
    Route::get('dorr_episode/show/{id}', 'Admin\episodes\EpisodeController@show')->name('dorr_episode.show');
    Route::get('mogmaa_episode/show/{id}', 'Admin\episodes\EpisodeController@show')->name('mogmaa_episode.show');

    Route::group(['namespace' => 'Admin\episodes'], function () {
        Route::resource('colleges', 'CollegeController');
        Route::get('colleges/episodes/{college_id}', 'CollegeController@create_custom')->name('colleges.episodes.create_custom');
        Route::get('colleges/episodes', 'EpisodeController@episodes')->name('colleges.episodes');
        Route::get('colleges/episodes/destroy/{id}', 'CollegeController@destroy')->name('destroy.college');
        Route::post('colleges/episodes/update', 'CollegeController@update')->name('college.update');
    });

    Route::group(['namespace' => 'Admin\episodes'], function () {
        Route::resource('dorr', 'DorrController');
        Route::get('dorr/episodes/{college_id}', 'DorrController@create_custom')->name('dorrs.episodes.create_custom');

        Route::get('dorr/episodes', 'DorrController@episodes')->name('dorr.episodes');
    });

    Route::resource('episode_students', 'Admin\episodes\EpisodeStudentsController');
    Route::get('episode_students/delete/{id}', 'Admin\episodes\EpisodeStudentsController@destroy')->name('episode_students.delete');
    Route::get('student/degrees/{stud_id}/{epo_id}', 'Admin\episodes\EpisodeStudentsController@student_degrees')->name('student.degrees');

    Route::group(['prefix' => "settings/episodes", 'namespace' => 'Admin\Settings'], function () {
        Route::get('suar', 'EpisodeSettingsController@suar_index')->name('settings.episodes.suar');
        Route::post('suar', 'EpisodeSettingsController@suar_store')->name('settings.episodes.suar.store');
        Route::post('suar/update', 'EpisodeSettingsController@suar_update')->name('settings.episodes.suar.update');
        Route::get('suar/delete/{id}', 'EpisodeSettingsController@suar_delete')->name('settings.episodes.suar.delete');
    });
    Route::group(['prefix' => "settings/sign_up", 'namespace' => 'Admin\Settings'], function () {
        //qualification
        Route::get('qualification', 'SignUpController@qualification_index')->name('qualification.index');
        Route::post('qualification', 'SignUpController@qualification_store')->name('qualification.store');
        Route::post('qualification/update', 'SignUpController@qualification_update')->name('qualification.update');
        Route::get('qualification/delete/{id}', 'SignUpController@qualification_delete')->name('qualification.delete');
        //nationality
        Route::get('nationality', 'SignUpController@nationality_index')->name('nationality.index');
        Route::post('nationality', 'SignUpController@nationality_store')->name('nationality.store');
        Route::post('nationality/update', 'SignUpController@nationality_update')->name('nationality.update');
        Route::get('nationality/delete/{id}', 'SignUpController@nationality_delete')->name('nationality.delete');
        //job_names
        Route::get('job_name', 'SignUpController@job_name_index')->name('job_name.index');
        Route::post('job_name', 'SignUpController@job_name_store')->name('job_name.store');
        Route::post('job_name/update', 'SignUpController@job_name_update')->name('job_name.update');
        Route::get('job_name/delete/{id}', 'SignUpController@job_name_delete')->name('job_name.delete');
        Route::post('job_name/change_status', 'SignUpController@job_name_change_status')->name('job_name.change_status');
        //country
        Route::get('country', 'SignUpController@country_index')->name('country.index');
        Route::post('country', 'SignUpController@country_store')->name('country.store');
        Route::post('country/update', 'SignUpController@country_update')->name('country.update');
        Route::get('country/delete/{id}', 'SignUpController@country_delete')->name('country.delete');
        //relations
        Route::get('relations', 'SignUpController@relations_index')->name('relations.index');
        Route::post('relations', 'SignUpController@relations_store')->name('relations.store');
        Route::post('relations/update', 'SignUpController@relations_update')->name('relations.update');
        Route::get('relations/delete/{id}', 'SignUpController@relations_delete')->name('relations.delete');
        //cities
        Route::get('cities/{id}/{country_id}', 'SignUpController@cities_index')->name('cities.show');
        Route::post('cities', 'SignUpController@cities_store')->name('cities.store');
        Route::post('cities/update', 'SignUpController@cities_update')->name('cities.update');
        Route::get('cities/delete/{id}', 'SignUpController@cities_delete')->name('cities.delete');
        //zones
        Route::get('zones/{id}', 'SignUpController@zones_index')->name('zones.show');
        Route::post('zones', 'SignUpController@zones_store')->name('zones.store');
        Route::post('zones/update', 'SignUpController@zones_update')->name('zones.update');
        Route::get('zones/delete/{id}', 'SignUpController@zones_delete')->name('zones.delete');
        //district
        Route::get('district/{id}/{country_id}/{zone_id}', 'SignUpController@district_index')->name('district.show');
        Route::post('district', 'SignUpController@district_store')->name('district.store');
        Route::post('district/update', 'SignUpController@district_update')->name('district.update');
        Route::get('district/delete/{id}', 'SignUpController@district_delete')->name('district.delete');
    });
    Route::get('settings/messages', 'Admin\Settings\MessageSettingsController@index')->name('settings.messages');

    Route::get('get_subjects/{id}', 'Admin\episodes\EpisodeController@get_subjects');
    Route::get('get_subject_levels/{id}', 'Admin\episodes\EpisodeController@get_subject_levels');
    Route::get('get_subject_sign_up_levels/{id}', 'Admin\episodes\EpisodeController@get_subject_levels');

    Route::get('get_students/{id}', 'Admin\Reports\BasicController@get_students');
    Route::get('get_teachers/{id}', 'Admin\Reports\BasicController@get_teachers');
    Route::get('get_zones/{id}', 'Admin\Reports\BasicController@get_zones');
    Route::get('get_cities/{id}', 'Admin\Reports\BasicController@get_cities');
    Route::get('get_districts/{id}', 'Admin\Reports\BasicController@get_districts');
    Route::get('get_episodes/{id}', 'Admin\Reports\BasicController@get_episodes');


    //ErrorType
    Route::get('subjects/ErrorType/mogmaa', 'Admin\episodes\ErrorTypeController@ErrorType_index')->name('ErrorType.index');
    Route::post('subjects/ErrorType/mogmaa', 'Admin\episodes\ErrorTypeController@ErrorType_store')->name('ErrorType.store');
    Route::post('subjects/ErrorType/mogmaa/update', 'Admin\episodes\ErrorTypeController@ErrorType_update')->name('ErrorType.update');
    Route::get('subjects/ErrorType/mogmaa/delete/{id}', 'Admin\episodes\ErrorTypeController@ErrorType_delete')->name('ErrorType.delete');

    Route::resource('levels', 'Admin\episodes\LevelController');
    Route::post('levels/update_new', 'Admin\episodes\LevelController@update')->name('levels.update_new');
    Route::get('levels/{id}/delete', 'Admin\episodes\LevelController@destroy');

    Route::resource('Academic_years', 'Admin\Academic_yearsController');
    Route::post('Academic_years/update_new', 'Admin\Academic_yearsController@update')->name('Academic_years.update_new');
    Route::get('Academic_years/{id}/delete', 'Admin\Academic_yearsController@destroy');

    Route::get('get_Academic_semesters/{id}', 'Admin\Academic_semestersController@get_Academic_semesters');
    Route::get('Academic_semester/{id}', 'Admin\Academic_semestersController@index');
    Route::resource('Academic_semester', 'Admin\Academic_semestersController');
    Route::post('Academic_semester/update_new', 'Admin\Academic_semestersController@update')->name('Academic_semester.update_new');
    Route::get('Academic_semester/{id}/delete', 'Admin\Academic_semestersController@destroy');

    Route::resource('subjects', 'Admin\episodes\SubjectController');
    Route::post('subjects/update_new', 'Admin\episodes\SubjectController@update')->name('subjects.update_new');
    Route::get('subjectss/{id}/delete', 'Admin\episodes\SubjectController@destroy')->name('subjectss.delete');

    Route::resource('subject_levels', 'Admin\episodes\SubjectLevelsController');
    Route::post('subject_levels/update_new', 'Admin\episodes\SubjectLevelsController@update')->name('subject_levels.update_new');
    Route::get('subjects_levels/{id}/delete', 'Admin\episodes\SubjectLevelsController@destroy')->name('subjects_levels.delete');

    Route::resource('subject_evaluation', 'Admin\episodes\SubjectEvaluationController');

    Route::resource('subject_levels_daily_plan', 'Admin\episodes\SubjectLevelDailyPlanController');
    Route::get('subject_levels_daily_plan/create_new/{sub_level_id}', 'Admin\episodes\SubjectLevelDailyPlanController@create')->name('subject_levels_daily_plan.create_new');

    Route::post('/plan/update', 'Admin\episodes\SubjectLevelDailyPlanController@update')->name('plan.update');
    Route::get('/plan/edit/{id}/{type}', 'Admin\episodes\SubjectLevelDailyPlanController@edit')->name('plan.edit');

    Route::post('/plan/new/store', 'Admin\episodes\SubjectLevelDailyPlanController@store_plan_new')->name('plan.new.store');

    Route::get('/plan/new/delete/{id}', 'Admin\episodes\SubjectLevelDailyPlanController@delete_new')->name('plan.new.delete');

    Route::post('/plan/tracomy/store', 'Admin\episodes\SubjectLevelDailyPlanController@store_plan_tracomy')->name('plan.tracomy.store');
    Route::get('/plan/tracomy/delete/{id}', 'Admin\episodes\SubjectLevelDailyPlanController@delete_tracomy')->name('plan.tracomy.delete');

    Route::post('/plan/revision/store', 'Admin\episodes\SubjectLevelDailyPlanController@store_plan_revision')->name('plan.revision.store');
    Route::get('/plan/revision/delete/{id}', 'Admin\episodes\SubjectLevelDailyPlanController@delete_revision')->name('plan.revision.delete');


    Route::get('profile', 'Admin\HomeController@profile')->name('profile');
    Route::get('change_pass', 'Admin\HomeController@profile')->name('change_pass');
    Route::post('/change_pass/update/password', 'Admin\HomeController@update_pass')->name('change_pass.update.pass');
    Route::post('/profile/update', 'Admin\HomeController@store_profile')->name('admin.store.profile');

    Route::resource('web_settings', 'Admin\web_settings\Web_SettingsController');
    Route::resource('episode_rate_questions', 'Admin\web_settings\EpisodeQuestionsRatesController');
    Route::post('episode_rate_questions/update', 'Admin\web_settings\EpisodeQuestionsRatesController@update')->name('episode_rate_questions.update_new');
    Route::get('episode_rate_questions/delete/{id}', 'Admin\web_settings\EpisodeQuestionsRatesController@destroy')->name('episode_rate_questions.delete.new');
    Route::resource('sliders', 'Admin\web_settings\SlidersController');
    Route::get('sliders/{id}/delete', 'Admin\web_settings\SlidersController@destroy')->name('delete.slider');
    Route::post('sliders/update_new', 'Admin\web_settings\SlidersController@update_new')->name('sliders.update_new');

//    sms

    Route::get('sms_settings/show','Admin\SmsController@index')->name("sms.settings");
    Route::get('sms_settings/create','Admin\SmsController@create')->name("sms.settings.create");
    Route::post('sms_settings/edit','Admin\SmsController@update')->name('sms.update');
    Route::post('sms_settings/store/message','Admin\SmsController@store')->name('sms.settings.store');

//    endsms
    Route::get('teacher_settings/{epo_type}', 'Admin\Teachers\TeacherSettingsController@index');
    Route::get('teacher_settings/edit/{id}', 'Admin\Teachers\TeacherSettingsController@edit')->name('teacher_settings.edit');
    Route::get('teacher_settings/make_member/{id}', 'Admin\Teachers\TeacherSettingsController@make_member')->name('teacher_settings.make_member');
    Route::get('study_teachers', 'Admin\Teachers\TeacherSettingsController@study_teachers')->name('teacher_settings.study_teachers');
    Route::post('teacher_settings/update/{id}', 'Admin\Teachers\TeacherSettingsController@update')->name('teacher_settings.update');
    Route::post('teacher_settings/store/new', 'Admin\Teachers\TeacherSettingsController@store')->name('store_new_teacher');

    //teacher absence ....
    Route::get('absence/show/teacher_settings', 'Admin\Teachers\TeacherSettingsController@show_absence')->name('absence.show.teacher');
    Route::get('absence/show/search/teacher_settings', 'Admin\Teachers\TeacherSettingsController@search_show_absence')->name('absence.search.teacher');
    Route::get('absence/show/search/teacher_settings/delete/{id}', 'Admin\Teachers\TeacherSettingsController@destroy_absence')->name('absence.destroy.teacher');
    Route::get('absence/show/search/user/delete/{id}', 'Admin\Teachers\TeacherSettingsController@destroy_absence_user')->name('absence.destroy.user');

    Route::get('absence/add/teacher_settings', 'Admin\Teachers\TeacherSettingsController@absence')->name('absence.add.teacher');
    Route::get('absence/{type}/teacher_settings', 'Admin\Teachers\TeacherSettingsController@absence_episode_multi')->name('absence.multi.teacher');
    Route::get('absence/{type}/{college_id}/teacher_settings', 'Admin\Teachers\TeacherSettingsController@absence_episode_college')->name('absence.college.teacher');
    Route::get('absence/teacher_settings/update/{id}', 'Admin\Teachers\TeacherSettingsController@absence_update')->name('absence.update.teacher');
    Route::get('absence/user/update/{id}', 'Admin\Teachers\TeacherSettingsController@absence_update_user')->name('absence.update.user');
    Route::get('absence/episode/teachers/{id}/{type}', 'Admin\Teachers\TeacherSettingsController@episode_teachers')->name('episode.teachers');
    Route::post('absence/teacher_settings/store', 'Admin\Teachers\TeacherSettingsController@store_absence')->name('teacher.store.absence');
    Route::get('absence/teacher_settings/colleges/{type}/{college_type}', 'Admin\Teachers\TeacherSettingsController@absence_colleges')->name('absence.colleges');


    Route::get('join_orders_rejected/students_rejected', 'Admin\web_settings\Web_SettingsController@join_orders_rejected')->name('join_orders_rejected.students');
    Route::get('join_orders_rejected/teachers_rejected', 'Admin\web_settings\Web_SettingsController@join_orders_rejected')->name('join_orders_rejected.teachers');


    Route::resource('blogs', 'Admin\web_settings\BlogsController');
    Route::get('blogs/{id}/delete', 'Admin\web_settings\BlogsController@destroy')->name('delete.blogs');
    Route::post('blogs/update_new', 'Admin\web_settings\BlogsController@update_new')->name('blogs.update_new');


    Route::resource('contact_us', 'Admin\web_settings\Contact_usController');
    Route::get('contact_us/{id}/delete', 'Admin\web_settings\Contact_usController@destroy')->name('delete.contact_us');
    Route::get('contact_us/{id}/block', 'Admin\web_settings\Contact_usController@block')->name('block.contact_us');

    //users  routes
    Route::resource('users', 'Admin\UsersController');
    //for new join
    Route::get('user/accept/{id}', 'Admin\UsersController@accept')->name('user.accept');
    Route::get('user/reject/{id}', 'Admin\UsersController@reject')->name('user.reject');

    Route::get('/get_collage_by_role_id/{id}', 'Admin\UsersController@get_collage_by_role_id');
    Route::get('users/{id}/delete', 'Admin\UsersController@destroy');
    Route::post('users/actived', 'Admin\UsersController@update_Actived')->name('users.actived');
    //user permissions and roles
    Route::resource('roles', 'Admin\RoleController');
    // Route::post('/store_permission', 'Admin\RoleController@store_permission')->name('store_permission');
    Route::get('/roles/edit_new/{id}', 'Admin\RoleController@edit')->name('roles.edit_new');
    Route::post('/roles/update_permission/{id}', 'Admin\RoleController@update')->name('roles.update_permission');
    Route::post('roles/store_permission', 'Admin\RoleController@store_permission')->name('roles.store_permission');
    Route::get('/roles/destroy_new/{id}', 'Admin\RoleController@destroy')->name('roles.destroy_new');

    //student routes in admin panel
    Route::get('student_settings', 'Admin\Students\StudentSettingsController@index');
    Route::get('student_settings/destroy/{id}', 'Admin\Students\StudentSettingsController@destroy')->name('student_settings.destroy');
    Route::get('student_settings/follow_absence', 'Admin\Students\StudentSettingsController@follow_absence')->name('students.follow_absence');
    Route::post('student_settings/store/new', 'Admin\Students\StudentSettingsController@store')->name('store_new_student');
    Route::post('student_settings/edit/save_quran_num', 'Admin\Students\StudentSettingsController@edit_save_quran_num')->name('student.edit.save_quran_num');
    Route::post('student_settings/edit/save_limit', 'Admin\Students\StudentSettingsController@edit_save_limit')->name('student.edit.save_limit');

    Route::get('students/new', 'Admin\Students\StudentSettingsController@new_students')->name('students.new');
    Route::get('students/new/re_verify/mail/{id}/{type}', 'Admin\Students\StudentSettingsController@re_verify_mail')->name('students.re_verify.mail');

    Route::get('student_settings/{type}/show/{id}', 'Admin\Students\StudentSettingsController@details')->name('student.details');
    Route::post('/student_settings/actived', 'Admin\Students\StudentSettingsController@update_Actived')->name('student_settings.actived');
    Route::get('student_settings/{type}', 'Admin\Students\StudentSettingsController@show');
    Route::get('student_episode/delete/{id}', 'Admin\Students\StudentSettingsController@destroy_student_epo')->name('student_episode.delete');
    Route::post('student_episode/change', 'Admin\Students\StudentSettingsController@change_student_epo')->name('student_episode.change');
    Route::get('student/change_epo_type/{id}', 'Admin\Students\StudentSettingsController@change_student_epo_type')->name('student_epo_type.change');
    Route::get('student/{type}/{id}/place/subject/edit', 'Admin\Students\StudentSettingsController@edit_student_subject')->name('student.place.subject.edit');
    Route::post('student/place/subject', 'Admin\Students\StudentSettingsController@update_subject_data')->name('student.place.subject');
    Route::post('student/place/episode', 'Admin\Students\StudentSettingsController@place_episode')->name('student.place.episode');
    Route::get('student/place/episode/{type}/{student_id}', 'Admin\Students\StudentSettingsController@place_episode_multi')->name('student.get.episode');
    Route::get('student/exists/dorr/{student_id}/{type}', 'Admin\Students\StudentSettingsController@student_exists_dorr')->name('student.exists.dorr');
    Route::get('student_settings/edit/{id}', 'Admin\Students\StudentSettingsController@edit')->name('edit.student_settings');
    Route::get('student_settings/place/selected/student/{episode_id}/{student_id}', 'Admin\Students\StudentSettingsController@place_selected_student')->name('place.selected.student');
    Route::post('student_settings/update/{id}', 'Admin\Students\StudentSettingsController@update')->name('update.student_settings');
    Route::group(['prefix' => "student", 'namespace' => "Admin\Students"], function ($router) {
        Route::get('new_join', 'StudentSettingsController@new_join')->name('student.new_join');
        Route::get('change_status/{id}', 'StudentSettingsController@change_status')->name('student.change_status');
        Route::get('accept/{id}', 'StudentSettingsController@accept')->name('student.accept');
        Route::get('reject/{id}', 'StudentSettingsController@reject')->name('student.reject');
    });

    //teacher routes in admin panelinbox/out
    Route::group(['prefix' => "teacher", 'namespace' => "Admin\Teachers"], function ($router) {
        Route::get('/teacher_info/{teacher_id}', 'TeacherSettingsController@teacher_info')->name('teacher_info');
        Route::get('new_join', 'TeacherSettingsController@new_join')->name('teacher.new_join');
        Route::get('change_status/{id}', 'TeacherSettingsController@change_status')->name('teacher.change_status');
        Route::get('accept/{id}', 'TeacherSettingsController@accept')->name('teacher.accept');
        Route::get('reject/{id}', 'TeacherSettingsController@reject')->name('teacher.reject');
        Route::post('/teacher_settings/actived', 'TeacherSettingsController@update_Actived')->name('teacher_settings.actived');
        Route::get('/teacher_settings/destroy/{id}', 'TeacherSettingsController@destroy')->name('teacher_settings.destroy');

        //teacher interview
        Route::get('/interviews', 'InterviewsController@index')->name('teacher.interviews');
        Route::post('/interviews', 'InterviewsController@store')->name('teacher.store.interviews');
        Route::get('/interviews/show/{id}', 'InterviewsController@show')->name('teacher.show.interviews');
        Route::post('/interviews/update/{id}', 'InterviewsController@update')->name('teacher.edit.interviews');
        Route::get('/interviews/destroy/{id}', 'InterviewsController@destroy')->name('teacher.destroy.interviews');

        //zoom room
        Route::get('/interviews/zoom/room/{id}', 'InterviewsController@zoom_room')->name('interviews');
        Route::get('/interviews/selected/show/zoom/{id}', 'InterviewsController@zoom')->name('teacher.zoom.interviews');

        //teacher interview
        Route::get('/teacher_requests', 'RequestsController@index')->name('teacher.absence.requests');
        Route::get('/teacher_requests/change_status/{id}/{status}', 'RequestsController@change_status')->name('teacher.absence.requests.change_status');





    });
    //reports
    Route::group(['prefix' => "reports", 'namespace' => "Admin\Reports"], function ($router) {

        //data
        Route::get('data/basic', 'BasicController@index')->name('reports.basic');
        Route::get('data/basic/search', 'BasicController@search')->name('reports.basic.search');

        //attendance
        Route::get('attendance', 'AttendanceController@index')->name('reports.attendance');
        Route::get('attendance/search', 'AttendanceController@search')->name('reports.attendance.search');
        Route::get('attendance/search_period/{id}', 'AttendanceController@search_period')->name('reports.attendance.search.period');
        Route::get('attendance/search_step_one', 'AttendanceController@search_step_one')->name('reports.attendance.search.step_one');
        Route::get('attendance/search_step_two', 'AttendanceController@search_step_two')->name('reports.attendance.search.step_two');
        Route::get('attendance/search_step_three', 'AttendanceController@search_step_three')->name('reports.attendance.search.step_three');

        //student_history
        Route::get('student_history', 'StudentHistoryController@index')->name('reports.student_history');
        Route::get('student_history/search', 'StudentHistoryController@search')->name('reports.student_history.search');
        Route::get('student_history/show/{id}', 'StudentHistoryController@show_history')->name('student.level.history');

        //employee data
        Route::get('teacher/data', 'TeacherDataController@index')->name('reports.teacher.data');
        Route::get('teacher/data/search', 'TeacherDataController@search')->name('reports.teacher.data.search');
        Route::get('job_name/history/{id}', 'TeacherDataController@job_name_history')->name('teacher.job_name.history');

        //teacher_attendance
        Route::get('teacher/attendance', 'TeacherAttendanceController@index')->name('reports.teacher.attendance');
        Route::get('teacher/attendance/search/step_one', 'TeacherAttendanceController@search_step_one')->name('reports.teacher.attendance.search.step_one');
        Route::get('teacher/attendance/search/step_two', 'TeacherAttendanceController@search_step_two')->name('reports.teacher.attendance.search.step_two');
        Route::get('teacher/attendance/search/step_three', 'TeacherAttendanceController@search_step_three')->name('reports.teacher.attendance.search.step_three');

        //old
        Route::get('teacher/attendance/search', 'TeacherAttendanceController@search')->name('reports.teacher.attendance.search');
        Route::get('teacher/attendance/details/{id}', 'TeacherAttendanceController@details')->name('teacher.attendance.details');
        Route::get('teacher/attendance/search_period/{id}', 'TeacherAttendanceController@search_period')->name('reports.teacher.attendance.search.period');

        Route::get('students_degree', 'StudentDegreeController@index')->name('reports.students_degree');

        //Productivity
        Route::get('productivity_old', 'ProductivityController@index_old')->name('reports.productivity_old');
        Route::get('productivity/search_step_one', 'ProductivityController@search_step_one')->name('reports.productivity.search_step_one');
        Route::get('productivity/search_step_two', 'ProductivityController@search_step_two')->name('reports.productivity.search_step_two');
        Route::get('productivity/search_step_three', 'ProductivityController@search_step_three')->name('reports.productivity.search_step_three');
        Route::get('productivity/search_step_four', 'ProductivityController@search_step_four')->name('reports.productivity.search_step_four');

        Route::get('productivity', 'ProductivityController@index')->name('reports.productivity');
        Route::get('productivity/search', 'ProductivityController@search')->name('reports.productivity.search');
        Route::get('productivity/student/episodes/{id}', 'ProductivityController@student_episodes')->name('student.productive.episodes');
        Route::get('productivity/mogmaa/episodes/{id}', 'ProductivityController@mogmaa_episodes')->name('mogmaa.productive.episodes');
        Route::get('productivity/teacher/episodes/{id}', 'ProductivityController@teacher_episodes')->name('teacher.productive.episodes');


        Route::get('teacher/Achievement', 'TeacherAchievementsController@index')->name('reports.teacher.Achievement');
        Route::get('teacher/Achievement/search', 'TeacherAchievementsController@search')->name('reports.teacher.Achievement.search');
        Route::get('teacher/Achievement/episodes/{id}', 'TeacherAchievementsController@teacher_episodes')->name('teacher.Achievement.episodes');

        Route::get('teacher/rates', 'TeacherRatesController@index')->name('reports.teacher.rates');
        Route::get('teacher/rates/search', 'TeacherRatesController@search')->name('reports.teacher.rates.search');

        Route::get('student/reciting_today', 'StudntListingController@index')->name('reports.reports.reciting_today');
        Route::post('student/reciting_today', 'StudntListingController@search')->name('reports.reports.reciting_today.search');

        //certificates
        Route::get('/certificates', 'CertificatesController@index')->name('reports.certificates');

        //episode rates
        Route::get('/rates/epo_type', 'EpisodeRatesController@epo_type')->name('reports.rates.epo_type');
        Route::get('/rates/epo_type/search', 'EpisodeRatesController@search')->name('reports.rates.search');
        Route::get('/rates/for/{type}', 'EpisodeRatesController@index')->name('reports.rates');

        //student save lines report
        Route::get('student/student_save_lines', 'StudentSaveLineController@index')->name('reports.student_save_lines');
        Route::get('student/student_save_lines/search', 'StudentSaveLineController@search')->name('reports.student_save_lines.search');
    });
});
Route::get('/get_ayat_num/{id}', 'Admin\episodes\SubjectLevelDailyPlanController@get_ayat_num');
Route::get('lang/{lang}', 'HomeController@lang')->name('home.lang');
