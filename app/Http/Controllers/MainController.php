<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use MikeFrancis\Tokenizr\Tokenizr;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function index(Request $request)
    {
        if($request->input('form-submit')){

            $tokenizr = new Tokenizr();
            $tokenizr->setTokenLength(8);
            $token = $tokenizr->generate();

            DB::connection()->table('org_group')->insert([
                'group_name' => $request->input('group-name'),
                'token' => $token,
            ]);

            return redirect($token);
        }

        return view('main');
    }
}
