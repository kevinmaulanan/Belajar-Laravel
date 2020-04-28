@extends('Layout/main')
@section('title', 'Daftar Detail Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1>Form Data Mahasiswa </h1>
            <form method="post" action="/students/update/{{$students->id}}" enctype="multipart/form-data" >
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama" name="nama" value={{$students->nama}}>
                  @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="file">Masukkan foto</label>
                    <input type="file" name="file" class="form-control-file @error('file') is-invalid-file @enderror"  >
                    @error('file')
                    <div class="invalid-file-feedback text-danger">{{ $message }}</div>
                      @enderror
                </div>
              
            
        
               <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </div>
</div>
@endsection

