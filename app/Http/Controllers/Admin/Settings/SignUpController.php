<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Job_name;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\Relation;
use App\Models\Zone;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SignUpController extends Controller
{
    /**
qualification
     */
    public function qualification_index()
    {
        $data = Qualification::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.qualification', compact('data'));
    }
    public function qualification_store(Request $request)
    {
        $input = $request->all();
        Qualification::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function qualification_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Qualification::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function qualification_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        Qualification::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    /**
    nationality
     */
    public function nationality_index()
    {
        $data = Nationality::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.nationality', compact('data'));
    }
    public function nationality_store(Request $request)
    {
        $input = $request->all();
        Nationality::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function nationality_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Nationality::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function nationality_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        Nationality::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    /**
    job_names
     */
    public function job_name_index()
    {
        $data = Job_name::orderBy('id','desc')->get();
        return view('admin.settings.sign_up.job_name', compact('data'));
    }
    public function job_name_change_status(Request $request)
    {
        $data['deleted'] = $request->status;
        Job_name::where('id', $request->id)->update($data);
        return 1;
    }


    public function job_name_store(Request $request)
    {
        $input = $request->all();
        Job_name::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function job_name_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Job_name::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function job_name_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        Job_name::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    /**
    country
     */
    public function country_index()
    {
        $data = Country::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.Country.country', compact('data'));
    }
    public function country_store(Request $request)
    {
        $input = $request->all();
        Country::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function country_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Country::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function country_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        Country::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
    /**
    relations
     */
    public function relations_index(){
        $data = Relation::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.relations', compact('data'));
    }
    public function relations_store(Request $request){
        $input = $request->all();
        Relation::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function relations_update(Request $request){
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Relation::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function relations_delete(Request $request,$id) {
        $input['deleted'] = '1';
        Relation::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
    /**
    cities
     */
    public function cities_index($id,$country_id)
    {
        $data = City::where('zone_id',$id)->where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.Country.zones.cities.cities', compact('data','id','country_id'));
    }
    public function cities_show($country_id)
    {
        $data = City::where('country_id',$country_id)->where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.cities.cities', compact('data'));
    }
    public function cities_store(Request $request)
    {
        $input = $request->all();
        City::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function cities_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        City::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function cities_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        City::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
    /**
    zones
     */
    public function zones_index($id)
    {
        $data = Zone::where('country_id',$id)->where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.Country.zones.zones', compact('data','id'));
    }
    public function zones_store(Request $request)
    {
        $input = $request->all();
        Zone::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function zones_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Zone::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function zones_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        District::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
    /**
    district
     */
    public function district_index($id,$country_id,$zone_id)
    {
        $data = District::where('city_id',$id)->where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.sign_up.Country.zones.cities.district.district', compact('data','country_id','zone_id','id'));
    }
    public function district_store(Request $request)
    {
        $input = $request->all();
        District::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function district_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        District::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function district_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        District::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
}
