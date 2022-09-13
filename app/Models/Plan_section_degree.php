<?php

namespace App\Models;

use App\Models\Plan\Plan_new;
use App\Models\Plan\Plan_revision;
use App\Models\Plan\Plan_tracomy;
use Illuminate\Database\Eloquent\Model;

class Plan_section_degree extends Model
{
    protected $fillable = [
        'student_id', 'complex_degree','section_id','plan_id','errors_num','degree','plan_type','type','saved_lines','teacher_id','episode_id','rate_teacher'
    ];
    public function Plan_new()
    {
        return $this->belongsTo(Plan_new::class, 'plan_id');
    }
    public function Section()
    {
        return $this->belongsTo(Episode_section::class, 'section_id');
    }
    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id')->withDefault([
            'user_name'=>'',
        ]);;
    }
    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id')->withDefault([
            'name_ar'=>'','name_en'=>'',
        ]);;
    }
    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault([
            'user_name'=>'',
        ]);;
    }
    public function Plan_tracomy()
    {
        return $this->belongsTo(Plan_tracomy::class, 'plan_id');
    }
    public function Plan_revision()
    {
        return $this->belongsTo(Plan_revision::class, 'plan_id');
    }
    public function Ask_degree()
    {
        return $this->belongsTo(Far_learn_degree::class, 'degree');
    }

    public function Ask()
    {
        return $this->belongsTo(Student_Questions_episode::class, 'plan_id');
    }

    public function AskDegree()
    {
        return $this->belongsTo(Far_learn_degree::class, 'degree');
    }

}
