<?php

namespace App\Http\Controllers\Admin\episodes;

use App\Models\Student_Questions_episode;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\Episode_course_days;
use App\Models\Plan_section_degree;
use App\Models\Far_learn_degree;
use App\Models\Episode_student;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Certificat;
use App\Models\Episode;
use App\Models\Student;
use Carbon\Carbon;
use PDF;

class CertificatesController extends Controller
{
    public function index()
    {
        $data = Certificat::orderBy('created_at', 'desc')->get();

        return view('admin.episodes.certificats.index', compact('data'));
    }

    public function episode_certificates($id)
    {
        $data = Episode_student::Has('student')->where('episode_id', $id)->where('deleted', '0')->get();
        $episode = Episode::find($id);
        return view('admin.episodes.episode_students_certificates', compact('data', 'episode'));
    }

    public function certificate()
    {
        return view('admin.episodes.certificats.certificate');
    }

    public function create_certificate($student_id, $episode_id)
    {
        $student = Student::findOrFail($student_id);
        $episode = Episode::findOrFail($episode_id);

        //generate certificate period ...
        $from_period = Episode_course_days::where('episode_id', $episode->id)->orderBy('date', 'asc')->get()->first();
        $to_period = Episode_course_days::where('episode_id', $episode->id)->orderBy('date', 'desc')->get()->first();
        if (!$from_period) {
            Alert::success(trans('s_admin.warning'), trans('s_admin.you_should_add_days'));

            redirect()->back();
        }
        //generate from date separated
        $from_date_string = strtotime($from_period->date);

//        $hijri_date = Hijri::FullDate($from_date_string);
//        dd($hijri_date);
        $from_year = date("Y", $from_date_string);

        $from_month = date("m", $from_date_string);
        $from_day = date("d", $from_date_string);
        $from_date_string = date("Y-m-d", $from_date_string);
        //generate to date separated
        $to_date_string = strtotime($to_period->date);
        $to_year = date("Y", $to_date_string);
        $to_month = date("m", $to_date_string);
        $to_day = date("d", $to_date_string);
        $to_date_string = date("Y-m-d", $to_date_string);
        $created_at = Carbon::now()->format('Y-m-d');
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
        //gnerate episode surah ...
        $first_surah_ar = '';
        $last_surah_ar = '';
        $last_surah_en = '';
        $first_surah_en = '';
        if ($episode->type == 'mqraa') {

            $from_listening = Student_Questions_episode::where('student_id', $student_id)->where('episode_id', $episode_id)->orderBy('created_at', 'asc')->first();
            if ($from_listening) {
                $first_surah_ar = $from_listening->From_Surah->name_ar;
                $last_surah_ar = Student_Questions_episode::where('student_id', $student_id)->where('episode_id', $episode_id)->orderBy('created_at', 'desc')->first()->To_Surah->name_ar;
                $first_surah_en = Student_Questions_episode::where('student_id', $student_id)->where('episode_id', $episode_id)->orderBy('created_at', 'asc')->first()->From_Surah->name_en;
                $last_surah_en = Student_Questions_episode::where('student_id', $student_id)->where('episode_id', $episode_id)->orderBy('created_at', 'desc')->first()->To_Surah->name_en;
            }
        } else {
            $episode_student = Episode_student::where('student_id', $student_id)->where('episode_id', $episode_id)->first();
            $episode_student->Subject->From_Surah;
        }
        return view('admin.episodes.certificats.create', compact('created_at', 'student', 'episode', 'degree',
            'from_year', 'from_month', 'from_day', 'to_year', 'to_month', 'to_day', 'first_surah_ar', 'last_surah_ar', 'first_surah_en', 'last_surah_en', 'to_date_string', 'from_date_string'));
    }


    public function export_certificate(Request $request)
    {

        // dd($request->all());
        $Arabic = new \I18N_Arabic('Glyphs');
        $name = $Arabic->utf8Glyphs($request->name);
        $degree = $Arabic->utf8Glyphs($request->degree);
        $country = $Arabic->utf8Glyphs($request->country);
        $from_sur = $Arabic->utf8Glyphs($request->from_sur);
        $to_sur = $Arabic->utf8Glyphs($request->to_sur);
        $program = $Arabic->utf8Glyphs($request->program);
        $num = $Arabic->int2indic($request->num);
        $from_y = $Arabic->int2indic($request->from_y);
        $to_y = $Arabic->int2indic($request->to_y);

        $name_en = $request->name_en;
        $degree_en = $request->degree_en;
        $created_at = $request->created_at;
        $country_en = $request->country_en;
        $from_sur_en = $request->from_sur_en;
        $to_sur_en = $request->to_sur_en;
        $program_en = $request->program_en;
        $num_en = $request->num_en;
        $from_y_en = $request->from_y_en;
        $to_y_en = $request->to_y_en;

        $img = Image::make(public_path('uploads/certificate/certificates.jpg'))->resize(3507, 2480);

        $img->text($name, 2450, 910, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($num, 2500, 1000, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($country, 2500, 1080, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($from_sur, 2765, 1255, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($to_sur, 2200, 1255, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($program, 2430, 1165, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($degree, 2900, 1425, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($from_y, 2755, 1350, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($to_y, 2400, 1350, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($name_en, 500, 910, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($num_en, 500, 1000, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($country_en, 500, 1080, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($from_sur_en, 500, 1255, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($to_sur_en, 1350, 1255, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($degree_en, 500, 1435, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($program_en, 735, 1165, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($from_y_en, 735, 1350, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($to_y_en, 1175, 1350, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $img->text($created_at, 1600, 2435, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(48);
            $font->color('#000000');
        });

        $file_name = 'certificate_' . time() . '.jpg';

        $img->save(public_path('uploads/certificate/' . $file_name));
        //convert image to pdf here
            $pdf = PDF::loadView('admin.episodes.certificats.print_pdf', ['file_name' => $file_name]);
            $pdf_name = 'certificate_pdf_' . time() . '.pdf';
            $pdf->save(public_path() .'/uploads/certificate/'.$pdf_name);
        //end converting
        $data['image'] = $file_name;
        $data['pdf'] = $pdf_name;
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
