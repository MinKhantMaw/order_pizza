<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\UserContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //contact list
    public function contactList()
    {
        $contact=UserContact::orderBy('contact_id','desc')->paginate(5);
        if (count($contact) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('backend.contact.contact-list')->with(['contact'=>$contact,'status'=>$emptyStatus]);
    }
    // contact delete
    public function contactDelete($id)
    {
        $contact=UserContact::where('contact_id',$id)->delete();
        return back()->with(['contact'=>$contact,'delete'=>"Contact Deleted"]);
    }
    // contact search
    public function contactSearch(Request $request)
    {
        $search_contact=UserContact::where('user_name','like','%' . $request->search_data . '%')
                                        ->orWhere('email','like','%' . $request->search_data . '%')
                                        ->orWhere('phone','like','%' . $request->search_data . '%')
                                        ->orWhere('message','like','%' . $request->search_data . '%')
                                        ->orderBy('contact_id','desc')->paginate(5);
        return view('backend.contact.contact-list')->with(['contact'=>$search_contact]);
    }
}
