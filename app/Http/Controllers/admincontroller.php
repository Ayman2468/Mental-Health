<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admins;
use App\Models\User;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Requests\adminrequest;
use App\Http\Requests\adminrequestedit;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    //
    public function index()
    {
        $adminsdata = admins::select('id', 'name_' . LaravelLocalization::getcurrentlocale() . ' as name', 'email', 'college', 'division', 'mobile', 'position')->paginate(paginationcount);

        return view('admins.index', ['adminsdata' => $adminsdata]);
    }
    public function adminhome()
    {
        return view('admins.adminhome');
    }

    public function create($adminid)
    {
        $admindata = User::select('name_ar', 'name_en', 'email', 'college', 'division', 'mobile')->find($adminid);
        return view('auth.adminregister', ['admindata' => $admindata]);
    }

    public function store(adminrequest $request)
    {
        //insert
        if ($request->password == $request->passwordconfirm) {
            admins::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'password' => sha1($request->password),
                'college' => $request->college,
                'division' => $request->division,
                'mobile' => $request->mobile,
                'position' => $request->position,
            ]);
            return redirect(route('adminlogin'))->with(['success' => __('msg.registed successfully')]);
        } else {
            return redirect()->back()->withInput()->with(['ident' => __('msg.confirm password must be identical to password')]);
        }
    }

    public function adminlogin()
    {
        return view('auth.adminlogin');
    }
    public function dologin(Request $request)
    {
        // Logic

        $data = $this->validate($request, [

            "email"     => "required|email",
            "password"  => "required|min:6"
        ]);

        $pass = sha1($request->password);
        $a = admins::where('email', $request->email)->where('password', $pass)->select('id', 'name_ar', 'name_en', 'email', 'college', 'division', 'mobile', 'position')->get();
        if (!$a->isEmpty()) {
            foreach ($a as $admindata) {
                $request->session()->put('admindata', $admindata);
                return redirect('admin/adminhome');
            }
        } else {
            return redirect()->route('adminlogin')->withInput($request->only('email'));
        }
    }
    public function edit($adminid)
    {
        if (session()->get('admindata')->id == $adminid || session()->get('admindata')->position == 'master') {
            $admin = admins::find($adminid);
            if (!$admin) {
                return redirect('admin/index')->with(['message' => __('msg.admin doesn\'t exist')]);
            }
            $admindata = admins::select('id', 'name_ar', 'name_en', 'email', 'college', 'division', 'mobile')->find($adminid);
            return view('admins.edit', ['admindata' => $admindata]);
        } else {
            return redirect()->back();
        }
    }

    public function update(adminrequestedit $request, $adminid)
    {
        //update
        $admin = admins::find($adminid);
        if (!$admin) {
            return redirect('admin/index')->with(['message' => __('msg.admin doesn\'t exist')]);
        }
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'college' => $request->college,
            'division' => $request->division,
            'mobile' => $request->mobile,
        ];
        $op = admins::where('id', $adminid)->update($data);
        if ($op) {
            $message = __('msg.admin data updated successfully');
        } else {
            $message = __("msg.no change in data happened");
        }

        session()->flash('message', $message);
        if(session('admindata')->position == "master") {
        return redirect('admin/index');
        }else{
            return redirect('admin/display');
        }
    }
    public function masteredit($adminid)
    {
        $admin = admins::find($adminid);
        if (!$admin) {
            return redirect('admin/index')->with(['message' => __('msg.admin doesn\'t exist')]);
        }
        $admindata = admins::select('id', 'name_ar', 'name_en', 'email', 'password', 'college', 'division', 'mobile', 'position')->find($adminid);
        return view('admins.masteredit', ['admindata' => $admindata]);
    }

    public function masterupdate(adminrequest $request, $adminid)
    {
        //update
        $admin = admins::find($adminid);
        if (!$admin) {
            return redirect('admin/index')->with(['message' => __('msg.admin doesn\'t exist')]);
        }
        if ($request->password == $request->passwordconfirm) {
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => $request->password,
            'college' => $request->college,
            'division' => $request->division,
            'mobile' => $request->mobile,
            'position' => $request->position,
        ];}else{
            return redirect()->back()->withInput()->with(['ident' => __('msg.confirm password must be identical to password')]);
        }
        if ($admin->password != $request->password) {
            $data['password'] = sha1($request->password);
        }
        $op = admins::where('id', $adminid)->update($data);
        if ($op) {
            $message = __('msg.admin data updated successfully');
        } else {
            $message = __("msg.no change in data happened");
        }

        session()->flash('message', $message);
        return redirect('admin/index');
    }
    public function destroy($adminid)
    {
        //
        if (session()->get('admindata')->id == $adminid || session()->get('admindata')->position == 'master') {

            $op = admins::find($adminid)->delete();

            if ($op) {
                $message = __("msg.admin deleted");
            } else {
                $message = __("msg.error try again");
            }

            session()->flash('message1', $message);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function admindisplay()
    {
        if (null !== session()->get('admindata')) {
            return view('admins.admindisplay');
        } else {
            return redirect('home');
        }
    }
    public function problemssolved($admin_id)
    {
        if (session()->get('admindata')->id == $admin_id || session()->get('admindata')->position == 'master') {
            $admin = admins::find($admin_id);
            if ($admin) {
                $problems = $admin->problems()->paginate(paginationcount);
                return view('admins.problemssolved', compact('problems'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
