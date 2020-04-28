<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function updatedata(Request $request, $id)
    {
        $file = $request->file('file');

        if ($file) {
            $request->validate([
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = "KEVMAN-" . time() . '.' . $file->getClientOriginalExtension();

            $oldFoto = DB::table('students')->where('id', $id)->value('foto');

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
                Storage::delete(['public/img/' . $oldFoto]);
                $file->storeAs('public/img', $fileName);
            }


            return redirect('/')->with('message', 'Data Berhasil DiUpdate');
        } else {
            return $request->nama;
        }

        // DB::table('students')->where('id', $id)
        //     ->update([
        //         'nama' => $request->nama,
        //         'npm' => $request->npm,
        //     ]);
        return redirect('/students')->with('status', 'Data Berhasil DiUpdate');
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
