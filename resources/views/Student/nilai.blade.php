@extends('Layout/main')
@section('title', 'Daftar Mahasiswa')
    
@section('container')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Daftar Nilai {{$name}}</h1>
     
            <ul class="list-group">
               
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Matkul</th>
                        <th scope="col">Nilai</th>

                      </tr>
                    </thead>
                    @foreach ($nilai as $n)
              
                    <tbody>
                      <tr>
                        <th scope="row">{{$n->id}}</th>
                        <td>{{$n->name_matkul}}</td>
                        <td>{{$n->nilai}}</td>
                     
                      </tr>
                    </tbody>
                    @endforeach
                </table>
            </ul>
            </ul>
        </div>
    </div>
</div>
@endsection

