<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }
    
    public function complated()
    {
        $todos = Todo::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],
        ])->get();
        return view('dashboard/complated', compact('todos'));
    }

    public function updateComplated($id)
    {
        Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);
        return redirect('dashboard/todolist')->with('done', 'Todo has complated');
    }

    public function maketodo()
    {
        return view('dashboard/maketodo');
    }

    public function todolist()
    {
            $todos = Todo::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', 0],
            ])->get();
            return view('dashboard.todolist', compact('todos'));
        
      
    }
    
    public function welcome()
    {
        return view('dashboard/welcome');
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function registerAccount(Request $request) {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:4|max:8',
            'email' => 'required|email:dns',
            'password' => 'required|min:4',
        ]);
        //input data ke db
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        //redirect kemana setelah berhasil membuat akun
        return redirect('/')->with('success', 'Success make an account ! Please Login');
    }

    public function auth(Request $request) {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exist' => 'This username is not yet available',
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',

        ]);
    
        $user = $request->only('username', 'password');
        if(Auth::attempt($user)) {
            return redirect('/dashboard/welcome');
        }else {
            return redirect()->back()->with('error', 'Login failed, please check and try again !');
        }
        
    }


    public function register()
    {
        return view('register');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //tes koneksi blade dengan controller
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);

        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/dashboard/todolist')->with('successAdd', 'Successful adding todo data !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $todo = Todo::where('id', $id)->first();
        return view('dashboard.edittodo', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mengubah data di db
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);
        //cari baris data yang punya id sama dengan data id yg dikirim ke parameter
        //kalau udh ketemu, update column-column datanya
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/dashboard/todolist')->with('successUpdate', 'Data updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();
        return redirect('/dashboard/todolist')->with('successDelete', 'Data has deleted');
    }
}
