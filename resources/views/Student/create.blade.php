@extends('Layout/main')
@section('title', 'Daftar Detail Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Form Data Mahasiswa</h1>
            <form method="post" action="/students">
                @csrf
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama" name="nama">
                  @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="npm">Npm</label>
                    <input type="text" class="form-control  @error('npm') is-invalid @enderror" id="npm" placeholder="Masukkan npm" name="npm">
                    @error('npm')
                    <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Masukkan email" name="email">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" placeholder="Masukkan jurusan" name="jurusan">
                </div>
               <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection

