<?php

namespace App\Http\Controllers;

use App\Models\User;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Requests\userrequest;
use App\Http\Requests\userrequestedit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class usercontroller extends Controller
{
    //
    public function index()
    {
        $usersdata = User::select('id', 'name_' . LaravelLocalization::getcurrentlocale() . ' as name', 'email', 'age', 'college', 'division', 'mobile')->paginate(paginationcount);
        return view('users.index', ['usersdata' => $usersdata]);
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(userrequest $request)
    {
        //insert
        if ($request->password == $request->passwordconfirm) {
            User::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'age' => $request->age,
                'college' => $request->college,
                'division' => $request->division,
                'mobile' => $request->mobile,
            ]);
            return redirect('login')->with(['success' => __('msg.registed successfully')]);
        } else {
            return redirect()->back()->withInput()->with(['ident' => __('msg.confirm password must be identical to password')]);
        }
    }
    public function edit($userid)
    {
        if ($userid == Auth::user()->id || session()->get('admindata')->position == 'master') {
            $user = User::find($userid);
            if (!$user) {
                return redirect('user/index')->with(['message' => __('msg.user doesn\'t exist')]);
            }
            $userdata = User::select('id', 'name_ar', 'name_en', 'email', 'password', 'age', 'college', 'division', 'mobile')->find($userid);
            return view('users.edit', ['userdata' => $userdata]);
        } else {
            return redirect()->back();
        }
    }

    public function update(userrequestedit $request, $userid)
    {
        //update
        $user = User::find($userid);
        if (!$user) {
            return redirect('user/index')->with(['message' => __('msg.user doesn\'t exist')]);
        }
        // $data = $this->validate($request);
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'age' => $request->age,
            'college' => $request->college,
            'division' => $request->division,
            'mobile' => $request->mobile,
        ];
        $op = User::where('id', $userid)->update($data);
        if ($op) {
            $message = __('msg.user data updated successfully');
        } else {
            $message = __("msg.no change in data happened");
        }

        session()->flash('message', $message);
        return redirect('user/index');
    }
    public function destroy($userid)
    {
        //
        if ($userid == Auth::user()->id || session()->get('admindata')->position == 'master') {
            $op = User::find($userid)->delete();

            if ($op) {
                $message = __("msg.user deleted");
            } else {
                $message = __("msg.error try again");
            }

            session()->flash('message1', $message);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function userdisplay()
    {
        if (null !== Auth::user()) {
            return view('users.userdisplay');
        } else {
            return redirect('home');
        }
    }
    public function problems($user_id)
    {
        if ($user_id == Auth::user()->id || session()->get('admindata')->position == 'master') {
            $user = User::find($user_id);
            if ($user) {
                $problems = $user->problems()->paginate(paginationcount);
                return view('users.myproblems', compact('problems'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
