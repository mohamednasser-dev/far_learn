<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    public $afterCommit = true;

    /**
     * Handle the student "created" event.
     *
     * @param \App\Models\Student $student
     * @return void
     */
    public function created(Student $student)
    {
        $student->user_phone = $student->country_code . $student->phone;
        $student->save();
    }

    /**
     * Handle the student "updated" event.
     *
     * @param \App\Models\Student $student
     * @return void
     */
    public function updated(Student $student)
    {
        $student->user_phone = $student->country_code . $student->phone;
        $student->save();
    }

    /**
     * Handle the student "deleted" event.
     *
     * @param \App\Models\Student $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the student "restored" event.
     *
     * @param \App\Models\Student $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the student "force deleted" event.
     *
     * @param \App\Models\Student $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
