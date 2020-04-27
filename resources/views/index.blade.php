@extends('Layout/main')
@section('title', 'Kevin Maulana')
    
@section('container')
<div class="container">
    <div class="card" style="width: 20rem;">
        <img src="{{asset('/img/'. Session::get('foto'))}}"  class="card-img-top" alt="..." height="250" >
        <div class="card-body">
          <h5 class="card-title">{{Session::get('nama')}}</h5>
          <h5 class="card-title">{{Session::get('foto')}}</h5>
          <p class="card-text">{{Session::get('email')}}</p>
          <p class="card-text">{{Session::get('jurusan')}}</p>
        <a href="{{url('/students/myprofile')}}" class="btn btn-primary">Edit</a>
        </div>
      </div>
</div>

@endsection
