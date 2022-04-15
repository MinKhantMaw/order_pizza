<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use App\Models\UserContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class UserContactController extends Controller
{
    //contact create
    public function contactCreate(Request $request)
    {
        // validation message
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $data=$this->requestUserData($request);
        UserContact::create($data);
        return back()->with(['create' => "Contact Created Success"]);
    }
    private function requestUserData($request)
    {
        return [
            'user_id'=>auth()->user()->id,
            'user_name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ];
    }
}
