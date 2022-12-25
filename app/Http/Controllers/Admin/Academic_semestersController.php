<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic_semester;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Academic_semestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $year_id = $id;
        $data = Academic_semester::where('academic_year_id', $id)->orderBy('id', 'desc')->with('Year')->get();
        return view('admin.settings.episodes.Academic_year.Academic_semester.index', compact('data', 'year_id'));
    }

    public function get_Academic_semesters($id)
    {
        $data = Academic_semester::where('academic_year_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.settings.episodes.Academic_year.Academic_semester.select', compact('data'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:' . $request->from,
                'academic_year_id' => 'required',
            ]);
        Academic_semester::create($data);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input['from'] = $request->from;
        $input['to'] = $request->to;
        $input['name'] = $request->name;
        Academic_semester::where('id', $request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Academic_semester::find($id)->delete();
        Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
        return back();

    }
}
