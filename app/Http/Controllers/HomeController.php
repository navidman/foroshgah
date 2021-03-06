<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        alert()->success('نوییید جاااان','Message')->persistent('اوکی!');
        return view('home');
    }

    public function comment(Request $request) {

        // if (! $request->ajax()) {
        //     return response()->json([
        //         'status' => 'only ajax request is allowed'
        //     ]); 
        // }

        $validData = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'required',
            'comment' => 'required',
        ]);
        auth()->user()->comments()->create($validData);
        alert()->success('نظر شما با موفقیت ثبت شد');
        return back();
        // return response()->json([
        //     'status' => 'success'
        // ]);
    }
}
