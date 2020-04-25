@extends('Layout/main')
@section('title', 'Daftar Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1>Daftar Mahasiswa</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Action</th>
                    </tr>
                    
                <tbody>
                    @foreach($mahasiswa as $mhs)
                    <tr>
                    <td scope="row">{{$mhs->nama}}</td>
                        <td scope="row">{{$mhs->npm}}</td>
                        <td scope="row">{{$mhs->email}}</td>
                        <td scope="row">{{$mhs->jurusan}} </td>
                        <td scope="row">
                            <a href="" class="badge badge-success">Edit</a>
                            <a href="" class="badge badge-danger">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                    
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
