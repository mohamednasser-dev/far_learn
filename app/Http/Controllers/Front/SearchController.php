<?php
namespace App\Http\Controllers\Front;
use Spatie\Permission\Models\Model_has_role;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class SearchController extends Controller{


    public function index(){

        return view('front.search.index');
    }

}
