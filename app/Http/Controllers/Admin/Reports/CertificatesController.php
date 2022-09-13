<?php

namespace App\Http\Controllers\Admin\Reports;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Controllers\Controller;
use App\Models\Certificat;
use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Far_learn_degree;
use App\Models\Notification;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Subject_level;
use http\Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CertificatesController extends Controller
{
    public function index()
    {
        $student_ids = $this->getStudentsData();
        $data = Certificat::whereIn('student_id', $student_ids)->orderBy('created_at', 'desc')->get();
        return view('admin.episodes.certificats.index', compact('data'));
    }

    private function getStudentsData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::whereHas('Episode', function ($q) use ($episode_ids) {
                $q->whereIn('episode_id', $episode_ids);
            })->
            where('epo_type', 'mogmaa')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::whereHas('Episode', function ($q) use ($episode_ids) {
                $q->whereIn('episode_id', $episode_ids);
            })->where('epo_type', 'dorr')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->pluck('id')->toArray();
        } else {
            $episodes = [];
            return [];
        }
    }

    public function episode_certificates($id)
    {
        $data = Episode_student::where('episode_id', $id)->where('deleted', '0')->get();
        $episode = Episode::find($id);
        return view('admin.episodes.episode_students_certificates', compact('data', 'episode'));
    }

    public function certificate()
    {
        return view('admin.episodes.certificats.certificate');
    }

    public function create_certificate($student_id, $episode_id)
    {
        $student = Student::find($student_id);
        $episode = Episode::find($episode_id);

        //generate certificate period ...
        $from_period = Episode_course_days::where('episode_id', $episode->id)->orderBy('date', 'asc')->get()->first();
        $to_period = Episode_course_days::where('episode_id', $episode->id)->orderBy('date', 'desc')->get()->first();

        //generate from date separated
        $from_date_string = strtotime($from_period->date);

//        $hijri_date = Hijri::FullDate($from_date_string);
//        dd($hijri_date);
        $from_year = date("Y", $from_date_string);
        $from_month = date("m", $from_date_string);
        $from_day = date("d", $from_date_string);
        //generate to date separated
        $to_date_string = strtotime($to_period->date);
        $to_year = date("Y", $to_date_string);
        $to_month = date("m", $to_date_string);
        $to_day = date("d", $to_date_string);
        if ($episode->type == 'mqraa') {
            $sum = Plan_section_degree::where('type', 'ask')->where('episode_id', $episode->id)->where('student_id', $student->id)->get()->sum('degree');
            $count = Plan_section_degree::where('type', 'ask')->where('episode_id', $episode->id)->where('student_id', $student->id)->get()->count();
            if ($count != 0) {
                $final_degree = $sum / $count;
                $final_degree = (integer)$final_degree;
            } else {
                $final_degree = 1;
            }
            $degree = Far_learn_degree::findOrFail($final_degree);
        } else {
            $sum = Plan_section_degree::where('type', 'degree')->where('episode_id', $episode->id)->where('student_id', $student->id)->get()->sum('complex_degree');
            $count = Plan_section_degree::where('type', 'degree')->where('episode_id', $episode->id)->where('student_id', $student->id)->get()->count();
            if ($count != 0) {
                $final_degree = $sum / $count;
                $final_degree = (integer)$final_degree;
            } else {
                $final_degree = 1;
            }
            $degree = Far_learn_degree::findOrFail($final_degree);
        }
        return view('admin.episodes.certificats.create', compact('student', 'episode', 'degree',
            'from_year', 'from_month', 'from_day', 'to_year', 'to_month', 'to_day'));
    }


    public function export_certificate(Request $request)
    {
        // dd($request->all());
        $Arabic = new \I18N_Arabic('Glyphs');
        $name = $Arabic->utf8Glyphs($request->name);
        $degree = $Arabic->utf8Glyphs($request->degree);
        $num = $Arabic->int2indic($request->num);
        $from_d = $Arabic->int2indic($request->from_d);
        $from_m = $Arabic->int2indic($request->from_m);
        $from_y = $Arabic->int2indic($request->from_y);
        $to_d = $Arabic->int2indic($request->to_d);
        $to_m = $Arabic->int2indic($request->to_m);
        $to_y = $Arabic->int2indic($request->to_y);

        $img = Image::make(public_path('uploads/certificate/man.jpg'))->resize(800, 566);

        $img->text($name, 375, 248, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($degree, 180, 323, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($num, 130, 250, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_d, 583, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_m, 548, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_y, 497, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_d, 395, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_m, 360, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_y, 310, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });
        $file_name = 'certificate_' . time() . '.jpg';
        $img->save(public_path('uploads/certificate/' . $file_name));
        $data['image'] = $file_name;
        $data['name'] = $request->name;
        $data['degree'] = $request->degree;
        $data['record_number'] = $request->num;
        $data['episode_id'] = $request->episode_id;
        $data['student_id'] = $request->student_id;
        Certificat::create($data);
        $episode = Episode::find($request->episode_id);

        //send notification to student ..
        $input_student['student_id'] = $request->student_id;
        $input_student['type'] = 'student';
        $input_student['message_type'] = 'certificate';
        $input_student['title_ar'] = 'الشهادات';
        $input_student['title_en'] = 'Certificates';
        $input_student['message_ar'] = 'مبارك , تم اضافة شهادة الحلقة- ' . $episode->name_ar . ' - الي شهاداتك';
        $input_student['message_en'] = 'Congratulations, the certificate of episode - ' . $episode->name_en . '- has been added to your certificates';
        Notification::create($input_student);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return redirect(route('episode.details.certificates', $request->episode_id));
    }
}
