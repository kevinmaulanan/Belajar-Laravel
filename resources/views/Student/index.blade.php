@extends('Layout/main')
@section('title', 'Daftar Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Daftar Mahasiswa</h1>
            <a href="/students/create" class="btn btn-primary my-3"> Tambah Data Mahasiswa</a>

            @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            <ul class="list-group">
                @foreach ($students as $st)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{$st->nama}}
                   <a  href="/students/{{$st->id}}" class="badge badge-primary badge-pill">Detail</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

