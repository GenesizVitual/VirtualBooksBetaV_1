<?php

namespace App\Http\Controllers\Persediaan\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstansiResource;
use App\Http\Resources\UserResource;
use App\Model\Persediaan\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Model\Users;
use App\User;
use JWTAuth;

class UsersApi extends Controller
{
    

    public function login(Request $request){
        $credentials = $request->only('email','password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    
        $model = User::where('email',$credentials['email'])->first();
        $model->remember_token = $token;
        $model->save();
        return response()->json(compact('token'));
    }

    public function data_user(Request $req)
    {
        $exp = explode(" ", $req->header('Authorization'));
        $data_users =new UserResource(User::find(14));
        $data_instansi = new InstansiResource(Instansi::where('user_id', $data_users->id)->first());
        return response()->json(['users'=> $data_users, 'instansi'=>$data_instansi]);
    }


    public function register(Request $req){
        $validor = Validator::make($req->all(), [
            'name'=> 'required|string|max:255',
            'email'=> ' required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:6|confirmed'
        ]);

        if($validor->fails()){
            return response()->json($validor->errors()->toJson(),400);
        }
        $data = $req->except(['password_confirmation']);
        $data['password'] = bcrypt($req->password);
        $users = new Users($data);
        $users->save();
        $token = JWTAuth::fromUser($users);

        return response()->json(['user'=> $users, 'token'=> $token]);
    }

    public function getAuthenticatedUser(){
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}
