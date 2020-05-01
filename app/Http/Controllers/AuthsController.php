<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthsController extends Controller
{


    public function login()
    {
        return view('Auth/login');
    }

    public function loginPost(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = DB::table('account_students')->where('email', $request->email)->first();
        if ($data) {
            $profile = DB::table('students')->where('id', $data->id_student)->first();
            if (Hash::check($request->password, $data->password)) {
                if ($data->is_verifed == 0) {
                    return redirect('auth/login')->with('message', 'Email belum verifycation. Silahkan cek Email terlebih dahulu !');
                } else {
                    Session::put('id', $profile->id);
                    Session::put('email', $data->email);
                    Session::put('nama', $profile->nama);
                    Session::put('npm', $profile->npm);
                    Session::put('foto', $profile->foto);
                    Session::put('login', TRUE);

                    return redirect('/');
                }
            } else {
                return redirect('auth/login')->with('message', 'Password  Salah !');
            }
        } else {
            return redirect('auth/login')->with('message', 'Email Salah!');
        }
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
        if ($maxNPM) {
            DB::table('students')->insert([
                'nama' => $request->email,
                'npm' => $maxNPM + 1,
                'foto' => 'default.png',
                'id_jurusan' => 1,
            ]);
        } else {
            $maxNPMNew = 151800;
            DB::table('students')->insert([
                'nama' => $request->email,
                'npm' => $maxNPMNew,
                'foto' => 'default.png',
                'id_jurusan' => 1,
            ]);
        }

        $maxIdStudents = DB::table('students')->max('id');

        DB::table('account_students')->insert([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_student' => $maxIdStudents,
            'token' => bin2hex(random_bytes(32)),
        ]);

        $data =  DB::table('account_students')->where('email', $request->email)->value('token');

        Mail::send('Auth/sendemail', ['token' => $data, 'email' => $request->email], function ($message) use ($request) {
            $message->to([$request->email])->subject('Verification');
            $message->from('ptkevman@gmail.com', 'Kevman');
        });

        return redirect('auth/login')->with('message', 'Data berhasil di register, silahkan check Email');
    }


    public function verify(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        $user = DB::table('account_students')->where('token', $token)->where('email', $email)->first();

        if ($user) {
            DB::table('account_students')->where('email', $email)->update([
                'is_verifed' => 1,
                'token' => bin2hex(random_bytes(32)),
            ]);
            return redirect('auth/login')->with('message', 'Data berhasil di verifikasi, silahkan login');
        } else {
            return redirect('auth/login')->with('message', 'Kesalahan URL Server');
        }
    }
}
