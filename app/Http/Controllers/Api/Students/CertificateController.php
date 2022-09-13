<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificatesResources;
use App\Models\Certificat;
use Illuminate\Http\Request;
use Validator;

class CertificateController extends Controller
{
    public function Certificates(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $certificates = Certificat::where('student_id', $user->id)->orderBy('created_at','desc')->paginate(10);
            $data = CertificatesResources::collection($certificates)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}

