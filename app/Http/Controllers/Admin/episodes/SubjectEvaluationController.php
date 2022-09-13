<?php
namespace App\Http\Controllers\Admin\episodes;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Subject_evaluation;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *amount_tracomy
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'subject_id' => 'required',
                'type' => 'required',
                'amount_tracomy' => '',
                'highest_rate' => 'required',
                'excellent' => 'required',
                'very_good' => 'required',
                'good' => 'required',
                'not_pathing' => 'required'
            ]);
        if($request->type == 'daily'){
            $data_daily = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','daily')->first();
            if($data_daily != null){
                $updated_old = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','daily')->update($data);
                if($updated_old > 0){
                    Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
                }
            }else{
                $created_new = Subject_evaluation::create($data);
                if($created_new != null){
                    Alert::success(trans('s_admin.add'), trans('s_admin.added_s'));
                }
            }
        }else if($request->type == 'tracomy'){
            $data_daily = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','tracomy')->first();
            if($data_daily != null){
                $updated_old = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','tracomy')->update($data);
                if($updated_old > 0){
                    Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
                }
            }else{
                $created_new = Subject_evaluation::create($data);
                if($created_new != null){
                    Alert::success(trans('s_admin.add'), trans('s_admin.added_s'));
                }
            }
        }else if($request->type == 'revision'){
            $data_revision = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','revision')->first();
            if($data_revision != null){
                $updated_old = Subject_evaluation::where('subject_id',$request->subject_id)->where('type','revision')->update($data);
                if($updated_old > 0){
                    Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
                }
            }else{
                $created_new = Subject_evaluation::create($data);
                if($created_new != null){
                    Alert::success(trans('s_admin.add'), trans('s_admin.added_s'));
                }
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_daily = Subject_evaluation::where('subject_id',$id)->where('type','daily')->first();
        $data_tracomy = Subject_evaluation::where('subject_id',$id)->where('type','tracomy')->first();
        $data_revision = Subject_evaluation::where('subject_id',$id)->where('type','revision')->first();
        $subject_data = Subject::find($id);
        return view('admin.episodes.levels.subjects.evaluation.index' ,compact('data_tracomy','data_revision','data_daily','subject_data') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
