<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\ChangePasswordRequest;

class AdminController extends Controller
{
    public function index()
    {
        $id=Auth::user()->id;
        $admin_data=User::where('id',$id)->first();

        return view('backend.admin.profile')->with(['user'=>$admin_data]);
    }
    public function updateProfile($id,UpdateAdminRequest $request)
    {
       $update_profile=$this->requestUpdateProfile($request);
       User::where('id',$id)->update($update_profile);
       return back()->with(['update'=>'Update Data Successfully']);

    }
    public function changePassword($id)
    {
        User::where('id',$id)->first();
        return view('backend.admin.change-password');
    }
    public function updatePassword($id,ChangePasswordRequest $request)
    {
        $data=User::where('id',$id)->first();
        $old_password=$request->old_password;
        $new_password=$request->new_password;
        $confirm_password=$request->confirm_password;
        $hash_password=$data['password'];
        if (Hash::check($old_password, $hash_password)) {
           if($new_password != $confirm_password){
                return back()->with(['notSame'=>"New Password & Confirm Password don't match"]);
           }else{
               if (strlen($new_password) <= 6 || strlen($confirm_password) <=6) {
                    return back()->with(['short'=>"Password must be at least 6 characters"]);
               }else{
                $update_password=['password'=>Hash::make($new_password)];
                User::where('id',$id)->update($update_password);
                return back()->with(['update'=>'Update Password Successfully']);
               }
           }
        }else{
            return back()->with(['notMatch'=>'Password do not match...!']);
        }
    }

    private function requestUpdateProfile($request)
    {
        return[
            'name' => $request->name,
            'email' => $request->email,
        ];
    }

}
