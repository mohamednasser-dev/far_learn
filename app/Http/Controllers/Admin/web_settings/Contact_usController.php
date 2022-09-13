<?php

namespace App\Http\Controllers\Admin\web_settings;

use App\Http\Controllers\Controller;
use App\Models\BlockList;
use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Contact_usController extends Controller
{
    //Slider Actions
    public function index(){
        $contacts = Contact::orderBy('created_at','desc')->get();
        Contact::where('readed','0')->update(['readed'=>'1']);
        return view('admin.web_settings.out_website_settings.contact_us' ,compact('contacts') );
    }

    public function show($id)
    {
        //
    }
    public function block($id)
    {
        $contact = Contact::findOrFail($id);
        $data['client_ip'] = $contact->client_ip ;
        BlockList::create($data);
        Alert::success(trans('s_admin.block_user'), trans('s_admin.blocked_Success'));
        return redirect()->back();
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
        $player = Contact::where('id', $id)->first();
        $player->delete();
        Alert::success(trans('admin.delete'), trans('admin.deleteSuccess'));
        return back();
    }
}
