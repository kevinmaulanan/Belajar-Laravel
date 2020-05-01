<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class StudentsController extends Controller
{
    public function index()
    {
        $student =  Student::all();
        return view('/student/index', ['students' => $student]);
    }

    public function create()
    {
        return view('Student/create');
    }

    public function update(Student $students)
    {
        return view('Student/update', ['students' => $students]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|size:8',
            'email' => 'required|unique:students',
            'jurusan' => 'required'
        ]);
        Student::create($request->all());
        return redirect('/students')->with('status', 'Data Berhasil Ditambahkan');
    }

    public function show(Student $students)
    {
        return view('Student/detail', ['students' => $students]);
    }

    public function image(Request $request)
    {
        //check if input page
        if ($request->input('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        //get id usr login
        $id = Session::get('id');

        //get count for check data and looping pagination
        $count = ceil(DB::table('image_students')->where('id_student', $id)->count() / 6);

        //get data from next and pref page
        $next = $page + 1;
        $pref = $page - 1;

        //get data
        $data = DB::table('image_students')->where('id_student', $id)->limit(6)->offset(($page - 1)  * 6)->get();

        //create new array for lopping pagination
        $number = range(1, $count);

        //check data
        if ($count !== 0) {
            return view('Student/image', ['data' => $data, 'total' => $number, 'active' => $page, 'next' => $next, 'pref' => $pref]);
        } else {
            return view('Student/image', ['data' => null, 'message' => 'Tidak ada foto yang ditampilkan']);
        }
    }

    public function nilai(Student $students)
    {
        $idStudents = $students->id;
        $nameStudents = $students->nama;
        $nilai = DB::table('nilai_students')->join('matkuls', 'nilai_students.id_matkul', '=', 'matkuls.id')->select('nilai_students.id', 'matkuls.name_matkul', 'nilai_students.nilai')->where('nilai_students.id_student', $idStudents)->get();

        return view('Student/nilai', ['nilai' => $nilai, 'name' => $nameStudents]);
    }

    public function updatedata(Request $request, $id)
    {
        //get file
        $file = $request->file('file');

        //check input name
        $request->validate([
            'nama' => 'required'
        ]);

        //get email by user login
        $profileLogin = Session::get('email');

        //check if there is an file
        if ($file) {

            //check input file, whether image file or not
            $request->validate([
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            //get a name for the image to be uploaded
            $fileName = 'KEVMAN-' . $profileLogin . '-' . time() . '.' . $file->getClientOriginalExtension();

            //get oldfoto profile
            $oldFoto = DB::table('students')->where('id', $id)->value('foto');


            //check oldfoto profile
            if ($oldFoto == 'default.png') {
                DB::table('students')->update([
                    'nama' => $request->nama,
                    'foto' => $fileName,
                ]);

                $file->storeAs('public/img', $fileName);
            } else {
                DB::table('students')->update([
                    'nama' => $request->nama,
                    'foto' => $fileName,
                ]);

                //delete image from store
                Storage::delete(['public/img/' . $oldFoto]);

                //Save image to store
                $file->storeAs('public/img', $fileName);
            }
        } else {

            //if there is no input file, then only the name input
            DB::table('students')->where('id', $id)
                ->update([
                    'nama' => $request->nama,
                ]);
        }
        return redirect('/')->with('status', 'Data Berhasil DiUpdate');
    }


    public function postimage(Request $request)
    {
        //check input file, whether image file or not
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //get image data
        $file = $request->file('file');

        //check id and email user login
        $id = Session::get('id');
        $profileLogin = Session::get('email');

        //get a name for the image to be uploaded 
        $fileName = 'KEVMAN-Collection' . $profileLogin . '-' . time() . '.' . $file->getClientOriginalExtension();

        //insert data to database
        DB::table('image_students')->insert([
            'image_student' => $fileName,
            'id_student' => $id,
        ]);

        //Save image to store
        $file->storeAs('public/img/collection', $fileName);

        return redirect('students/image')->with('message', 'Data Berhasil Ditambahkan');
    }
}
