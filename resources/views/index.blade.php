@extends('Layout/main')
@section('title', 'Kevin Maulana')
    
@section('container')
<div class="container">
            @if(session('message'))
              <div class="alert alert-success">
                  {{session('message')}}
              </div>
            @endif
    <div class="card" style="width: 20rem;">
        <img src="{{asset('/storage/img/'. $myProfile->foto)}}"  class="card-img-top" alt="..." height="250" >
        <div class="card-body">
          <h5 class="card-title">{{$myProfile->nama}}   </h5>
          <p class="card-text">{{$myProfile->npm}}</p>
          <p class="card-text">{{$myProfile->jurusan}}</p>
        <a href="{{url('/students/myprofile/'.Session::get('id'))}}" class="btn btn-primary">Edit</a>
        </div>
      </div>
</div>

@endsection
