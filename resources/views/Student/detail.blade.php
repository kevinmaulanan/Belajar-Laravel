@extends('Layout/main')
@section('title', 'Daftar Detail Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-4">
            <h1>Detail Mahasiswa</h1>
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">{{$students->nama}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{$students->npm}}</h6>
                  <p class="card-text">{{$students->email}}</p>
                  <a href="/students/update/{{$students->id}}" class="btn btn-primary">Edit</a>
                  <a href="/students/delete/{{$students->id}}" class="btn btn-danger">Delete</a>

                  <a  href="/students/nilai/{{$students->id}}" class="badge badge-primary badge-pill">Lihat Nilai</a>
            
                  <a href="/students" class="card-link">Kembali</a>
                  
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

