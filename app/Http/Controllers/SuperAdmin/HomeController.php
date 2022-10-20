<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Database;
use App\Models\Level;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{

    public function login()
    {
        if (auth('web')->check()) {
            return redirect('/home');
        }
        return view('super_admin.login_new');
    }

    public function login_store(Request $request)
    {
        $remeber = Request('Remember') == 1 ? true : false;
        if (auth::guard('web')->attempt(['email' => $request->email, 'password' => Request('password')], $remeber)) {
            //Check if active user or not
            if (auth()->guard('web')->user()->is_new == 'y') {
                Auth::guard('web')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_not_accepted_yet'));
                return back();
            }
            if (auth()->guard('web')->user()->is_new == 'rejected') {
                Auth::guard('web')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_rejected'));
                return back();
            }
            if (auth()->guard('web')->user()->status != 'active') {
                Auth::logout();
                Alert::error(trans('admin.login'), trans('s_admin.pass_email_wrong_title'));
                return back();
            } else {
                Alert::success(trans('admin.login_done'), trans('admin.hello'));
                return redirect('/home');
            }
        } else {
            Alert::error(trans('s_admin.invalid_informations'), trans('admin.invaldemailorpassword'));
            return back();
        }
    }

    public function tenants()
    {
        $data = Tenant::get();
        $used_databases = Tenant::get()->pluck('database')->toArray();
        $databases = Database::whereNotIn('name',$used_databases)->get();
        return view('super_admin.tenants.index', compact('data','databases'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Tenant::create($data);
        Artisan::call('tenants:migrate --seed');
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
        $data = $request->all();
        Tenant::where('id', $request->id)->update($data);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            Tenant::where('id', $id)->delete();
            Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
        } catch (\Exception $exception) {
            Alert::error(trans('admin.delete'), trans('s_admin.ther_some_data_on_it'));
        }
        return back();
    }


}
