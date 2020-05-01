<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home()
    {
        $email = Session::get('email');
        $myProfile = DB::table('students')->join('account_students', 'account_students.id_student', '=', 'students.id')->join('jurusans', 'students.id_jurusan', '=', 'jurusans.id')->select('students.nama', 'students.foto', 'students.npm', 'jurusans.jurusan')->where('email', $email)->first();

        return view('index', ['myProfile' => $myProfile]);
    }

    public function about()
    {
        $nama = 'Kevin Maulana Nasrullah';
        return view('about', ['nama' => $nama]);
    }

    public function mahasiswa()
    {
        return view('mahasiswa');
    }
}
