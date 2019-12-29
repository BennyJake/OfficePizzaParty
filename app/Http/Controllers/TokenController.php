<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function index(Request $request, $token)
    {
        $userName = null;
        $toppingsList = DB::table('topping')->select('id', 'name')->orderBy('display_order')->get();

        $toppings = [];
        foreach($toppingsList as $singleTopping){
            $toppings[$singleTopping->id] = $singleTopping->name;
        }

        $orgGroupList = DB::table('org_group')->select('id', 'group_name')->where(['token' => $token])->get();
        $orgGroupName = $orgGroupList[0]->group_name;
        $orgGroupId = $orgGroupList[0]->id;

        $viewData = [
            'toppings' => $toppings,
            'url' => $request->fullUrl(),
            'groupName' => $orgGroupName,
        ];

        if ($request->input('submit') && !$request->session()->has(['user_id', 'group_id'])) {

                $userId = DB::table('user')->insertGetId([
                    'name' => $request->input('name'),
                    'org_group_id' => $orgGroupId,
                    'datetime_submit' => date('Y-m-d H:i:s', strtotime('now'))
                ]);

                foreach ($toppings as $singleToppingId => $singleToppingName) {
                    DB::table('user_topping')->insert([
                        'user_id' => $userId,
                        'topping_id' => $singleToppingId,
                        'topping_preference' => $request['topping_' . $singleToppingId]
                    ]);
                }

                $request->session()->put([
                    'user_id' => $userId,
                    'group_id' => $orgGroupId,
                ]);
        }

        if ($request->session()->has(['user_id', 'group_id'])){

            $userList = DB::table('user')->select('name')->where(['id' => $request->session()->get('user_id')])->get();
            $userName = $userList[0]->name;
            $viewData['userName'] = $userName;

            $groupOrgUserList = DB::table('org_group')
                ->join('user', 'user.org_group_id', '=', 'org_group.id')
                ->join('user_topping', 'user_topping.user_id', '=', 'user.id')
                ->join('topping', 'user_topping.topping_id', '=', 'topping.id')
                ->select(['user.name', 'topping_id', 'topping.name AS topping_name', 'topping_preference'])
                ->orderBy('topping_id')
                ->orderBy('user_id')
                ->get();

            $parsedGroupOrgUserList = [];
            foreach($groupOrgUserList as $groupOrgUser){
                $parsedGroupOrgUserList[$groupOrgUser->name][$groupOrgUser->topping_name] = $groupOrgUser->topping_preference;
            }

            $viewData['groupOrgUserList'] = $parsedGroupOrgUserList;
        }

        return view('token', $viewData);
    }
}
