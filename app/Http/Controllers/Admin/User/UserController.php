<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{

    public function __construct() 
    {   
        $this->middleware('can:show-users')->only(['index']);
        $this->middleware('can:edit-user')->only(['edit' , 'upadet']);
        $this->middleware('can:create-user')->only(['create' , 'store']);
        $this->middleware('can:delete-user')->only(['destroy']);


    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();

        if ($keyword = request('search')) {
            $users->where('email' , 'LIKE' , "%{$keyword}%")->orWhere('name' , 'LIKE' , "%{$keyword}%")->orWhere('id' , $keyword);
        }
        if (request('admin')) {
            $users->where('is_superuser' , 1)->orWhere('is_staff' , 1);
        }
         if(Gate::allows('show-staff-users')){
            if(\request('admin')){
                $users->where('is_superuser', 1)->orWhere('is_staff', 1);
            }
        }else{
            $users->where('is_superuser', 0)->Where('is_staff', 0);
        }

        $users = $users->latest()->paginate(20);
        return view('admin.users.all' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $user = User::create($data);

        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   

 
        // $this->authorize('edit-user' , $user);



        // if (auth()->user()->can('edit-user' , $user)) {
      
        //     return view('admin.users.edit' , compact('user'));
        // }
        // return abort(403);




        // $this->authorize('edit' , $user);
            
        return view('admin.users.edit' , compact('user'));
        


        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        // , Rule::unique('users')->ingnore($user->id)
        if (! is_null($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        $data['password'] = $request->password;
        }
        $user->update($data);
        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
