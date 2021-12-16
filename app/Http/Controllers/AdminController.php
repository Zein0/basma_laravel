<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AdminController extends Controller
{

    public function check(){
    return response()->json(['status'=>true]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('admin')->factory()->getTTL() * 60
        ]);
    }
    public function getUsers($id){
        $users=User::paginate($id);
        return response()->json(['users'=>$users,'status'=>true]);
    }
    public function getUser(){
        $users=User::all();
        return response()->json([ 'size'=>sizeof($users),'users'=>$users,'status'=>true]);
    }
    public function getNumber($id){
        $date =  Date::now();
        if($id==1){
            $date->modify("-1 day");
        }
        if($id==2){
            $date->modify("-1 week");
        }
        if($id==3){
            $date->modify("-1 month");
        }
        if($id==4){
            $date->modify("-3 month");
        }
        if($id==5){
            $date->modify("-1 year");
        }
        $users=User::where('created_at','>=',$date)->get();
        return response()->json(['size'=>sizeof($users),'users'=>$users,'status'=>true]);

    }
}
