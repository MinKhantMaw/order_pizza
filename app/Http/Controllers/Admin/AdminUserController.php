<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    // admin list
    public function adminList()
    {
         if(Session::has('ADMIN_SEARCH')){
            Session::forget('ADMIN_SEARCH');
        }
        $admin_user=User::paginate(5);
        return view('backend.admin.admin-list')->with(['admin_user'=>$admin_user]);
    }
    // admin account create
     public function createAdmin()
    {
        return view('backend.admin.admin-create');
    }
    // admin account add
    public function addAdmin(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
           return back()
           ->withErrors($validator)
           ->withInput();
        }
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'admin',
        ];
        User::create($data);
        return redirect()->route('admin.admin-list')->with(['adminSuccess'=>"Successfully Admin Added"]);
    }
    // admin account search
    public function adminSearch(Request $request)
    {
        $admin_search=User::where('name','like','%' . $request->admin_search . '%')
                            ->orWhere('email','like' ,'%' .$request->admin_search . '%')
                            ->paginate(5);
        $admin_search->appends($request->all());
        Session::put('ADMIN_SEARCH',$admin_search);
        return view('backend.admin.admin-list')->with(['admin_user'=>$admin_search]);
    }
    // admin account delete
    public function adminDelete($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('admin.admin-list')->with(['adminDelete'=>"Successfully Admin Deleted"]);
    }
    // cvs download
     public function adminDownload()
    {
        if (Session::has('ADMIN_SEARCH')) {
            $admin_search=User::where('name','like','%' . Session::get('ADMIN_SEARCH') . '%')
                                ->get(5);
        }else{
            $admin_search=User::get();
        }

        // dd($pizza->toArray());

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($admin_search, [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role ',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'admin.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
    // user list
    public function userList()
    {
        $user=User::where('role','user')->paginate(5);
        return view('backend.admin.user-list')->with(['user'=>$user]);
    }
    // user account search
    public function userSearch(Request $request)
    {
        $search_user=User::where('name','like','%' . $request->search_user . '%')
                            ->orWhere('email','like' ,'%' .$request->search_user . '%')
                            ->paginate(5);
        $search_user->appends($request->all());
        return view('backend.admin.user-list')->with(['user'=>$search_user]);
    }
    // user account delete
    public function userDelete($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('admin.user-list')->with(['delete'=>'User Deleted Successfully']);
    }
}
