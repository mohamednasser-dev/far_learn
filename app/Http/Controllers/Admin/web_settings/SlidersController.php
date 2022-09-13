<?php

namespace App\Http\Controllers\Admin\web_settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use RealRashid\SweetAlert\Facades\Alert;

class SlidersController extends Controller
{
    //Slider Actions
    public function index(){
        $sliders = Slider::all();
        return view('admin.web_settings.out_website_settings.sliders' ,compact('sliders') );
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,bmp',
                'title_ar' => '',
                'title_en' => '',
                'desc_ar' => '',
                'desc_en' => '',
            ]);
        if ($request['image'] != null)
        {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/sliders'), $fileNewName);
            $data['image'] = $fileNewName;
        }else{
            $data['image'] = 'default.png';
        }
        Slider::create($data);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function update_new(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'title_ar' => '',
                'title_en' => '',
                'desc_ar' => '',
                'desc_en' => '',
            ]);
        if ($request->image != null)
        {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/sliders'), $fileNewName);
            $data['image'] = $fileNewName;
        }else{
            unset($data['image']);
        }
        Slider::where('id',$request->id )->update($data);
        Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
        return back();
    }

    public function destroy($id)
    {
        $player = Slider::where('id', $id)->first();
        $player->delete();
        Alert::success(trans('admin.delete'), trans('admin.deleteSuccess'));
        return back();
    }

}
