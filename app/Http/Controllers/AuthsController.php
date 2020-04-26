<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login()
    {
        return view('Auth/login');
    }

    public function loginPost(Request $request)
    {
        dd($request);
        $request->validate([
            'email' => 'required|unique:account_students',
            'password' => 'required'
        ]);
        $data = DB::table('account_students')->where('email', $request->email);
        dd($data);
    }


    public function register()
    {
        return view('Auth/register');
    }


    public function registerpost(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:account_students',
            'password' => 'required'
        ]);

        $maxNPM = DB::table('students')->max('npm');

        DB::table('students')->insert([
            'nama' => $request->email,
            'npm' => $maxNPM + 1,
            'id_jurusan' => 1,
        ]);

        $maxIdStudents = DB::table('students')->max('id');

        DB::table('account_students')->insert([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_student' => $maxIdStudents
        ]);
        return redirect('auth/login')->with('message', 'Data berhasil di register, silahkan login');
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
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
