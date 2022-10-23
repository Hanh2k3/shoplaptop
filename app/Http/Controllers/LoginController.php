<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Models\Login; //sử dụng model Login


class LoginController extends Controller
{
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(Request $request){
        return 'dfs'; 
   
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            $request -> session() -> put('admin_login',$account_name->admin_name);
            $request -> session() -> put('admin_id',$account_name->admin_id);
            return redirect() ->  route('admin.dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $admin_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_status' => 1

                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $admin_login = Login::where('admin_id',$account->user)->first();

            $request -> session() -> put('admin_login',$admin_login->admin_name);
            $request -> session() -> put('admin_id',$admin_login->admin_id);
            return redirect() ->  route('admin.dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

}
