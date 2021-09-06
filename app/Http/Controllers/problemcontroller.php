<?php

namespace App\Http\Controllers;

use App\Models\problems;
use App\Models\admins;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Requests\problemrequest;
use App\Http\Requests\answerrequest;
use Illuminate\Support\Facades\Auth;


class problemcontroller extends Controller
{
    //
    public function index()
    {
        $problemsdata = problems::select('id', 'title', 'content', 'answer', 'user', 'admin', 'created_at', 'updated_at')->paginate(paginationcount);
        // $problemscount = problems::select('id', 'title', 'content', 'answer', 'user', 'admin', 'created_at', 'updated_at')->get();
        $adminsdata = admins::select('id', 'name_' . LaravelLocalization::getcurrentlocale() . ' as name')->get();
        foreach ($adminsdata as $adminid) {
            $howmanyproblems = problems::where('admin_id', $adminid->id)->get();
            $adminname = $adminid->name;
            $problemssolved = count($howmanyproblems);
            session()->put($adminname, $problemssolved);
        }
        $index = 'main';
        //return $problemsdata;
        return view('problems.index', ['index' => $index, 'problemsdata' => $problemsdata, 'adminsdata' => $adminsdata]);
    }
    public function unsolvedindex()
    {
        $problemsdata = problems::select('id', 'title', 'content', 'answer', 'user', 'admin', 'created_at', 'updated_at')->where('answer', 'waiting for answer')->paginate(paginationcount);
        $index = 'unsolved';
        return view('problems.index', ['index' => $index, 'problemsdata' => $problemsdata]);
    }
    public function solvedindex()
    {
        $problemsdata = problems::select('id', 'title', 'content', 'answer', 'user', 'admin', 'created_at', 'updated_at')->where('answer', '!=', 'waiting for answer')->paginate(paginationcount);
        return view('problems.index', ['index' => index, 'problemsdata' => $problemsdata]);
    }
    public function create()
    {
        return view('problems.create');
    }
    public function store(problemrequest $request)
    {
        //return Auth::user()->name_ar;
        //insert
        problems::create([
            'title' => $request->title,
            'content' => $request->content,
            'user' => Auth::user()->name_ar . ' / ' . Auth::user()->name_en,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()->with(['success' => __('msg.Problem added successfully')]);
    }
    public function edit($problemid)
    {
        $found = problems::select('id', 'title', 'content', 'answer', 'user', 'user_id', 'admin', 'created_at', 'updated_at')->find($problemid);
        if ($found->user_id == Auth::user()->id || session()->get('admindata')->position == 'master') {
            if (!$found) {
                return redirect('problem/problems')->with(['message' => __('msg.problem doesn\'t exist')]);
            }
            return view('problems.edit', ['problemdata' => $found]);
        } else {
            return redirect()->back();
        }
    }
    public function update(problemrequest $request, $problemid)
    {
        //update
        $problem = problems::find($problemid);
        if (!$problem) {
            return redirect('problem/problems')->with(['message' => __('msg.problem doesn\'t exist')]);
        }
        // $data = $this->validate($request);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        $op = problems::where('id', $problemid)->update($data);
        if ($op) {
            $message = __('msg.problem data updated successfully');
        } else {
            $message = __("msg.no change in data happened");
        }

        session()->flash('message', $message);
        return redirect()->back();
    }
    public function editwithanswer($problemid)
    {
        $found = problems::select('id', 'title', 'content', 'answer', 'user', 'admin', 'created_at', 'updated_at')->find($problemid);
        if (!$found) {
            return redirect('problem/unsolved-problems')->with(['message' => __('msg.problem doesn\'t exist')]);
        }
        return view('problems.answer', ['problemdata' => $found]);
    }
    public function updatewithanswer(answerrequest $request, $problemid)
    {
        //update
        $problem = problems::find($problemid);
        if (!$problem) {
            return redirect('problem/unsolved-problems')->with(['message' => __('msg.problem doesn\'t exist')]);
        }
        $admindata = session()->get('admindata');
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'answer' => $request->answer,
            'admin' => $admindata->name_ar . ' / ' . $admindata->name_en,
            'admin_id' => $admindata->id,
        ];
        $op = problems::where('id', $problemid)->update($data);
        if ($op) {
            $message = __('msg.problem answer added successfully (it will a generosity from you to answer another problem)');
        } else {
            $message = __("msg.the answer wasn't saved");
        }

        session()->flash('message', $message);
        return redirect('problem/unsolved-problems');
    }
    public function destroy($problemid)
    {
        //
        $found = problems::select('user_id')->find($problemid);
        if ($found->user_id == Auth::user()->id || session()->get('admindata')->position == 'master') {
            $op = problems::find($problemid)->delete();

            if ($op) {
                $message = __("msg.problem deleted");
            } else {
                $message = __("msg.error try again");
            }

            session()->flash('message1', $message);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function destroyall()
    {
        //
        $op = problems::truncate();

        if ($op) {
            $message = __("msg.all problems deleted");
        } else {
            $message = __("msg.error try again");
        }

        session()->flash('message1', $message);
        return redirect()->back();
    }
}
