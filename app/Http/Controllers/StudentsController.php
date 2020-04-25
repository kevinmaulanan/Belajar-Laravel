<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student =  Student::all();
        return view('/student/index', ['students' => $student]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Student/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $students)
    {
        return view('Student/detail', ['students' => $students]);
    }


    public function nilai(Student $students)
    {
        $idStudents = $students->id;
        $nameStudents = $students->nama;
        $nilai = DB::table('nilai_students')->join('matkuls', 'nilai_students.id_matkul', '=', 'matkuls.id')->select('nilai_students.id', 'matkuls.name_matkul', 'nilai_students.nilai')->where('nilai_students.id_student', $idStudents)->get();

        return view('Student/nilai', ['nilai' => $nilai, 'name' => $nameStudents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $students)
    {
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
