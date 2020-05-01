@extends('Layout/main')
@section('title', 'Daftar Mahasiswa')
    
@section('container')
<div class="container">

    @if($data==null)
        <div class="alert alert-danger">
            <h4>{{$message}}</h4>
        </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success">
        <h4>{{session('message')}}</h4>
    </div>
    @endif


    <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#createImageModal"> Tambah Foto </button>
    

    <div class="row">
    @foreach ($data as $d)
        <div class="col-sm-4 col-md-3 col-lg-2">
            <div class="card" style="width: 300px, margin-left:10px">
                <img class="card-img-top" src="{{asset('/storage/img/collection/'. $d->image_student)}}" alt="Card image cap" height="150">
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-3">
        <nav aria-label="...">
            <ul class="pagination">

            <li class="page-item">
               
                <a class="page-link" href="{{url('/students/image?page='.$pref)}}" tabindex="-1">Previous</a>
            </li>
            
            @foreach ($total as $t)
            <li class="page-item @if($t==$active) active @endif  ">
                <a class="page-link" href="{{url('/students/image?page='.$t)}}"> {{$t}} <span class="sr-only">(current)</span></a>
            </li>
            @endforeach

            
                <a class="page-link" href="{{url('/students/image?page='.$next)}}">Next</a>
            </li>
            </ul>
       
        </nav>
    </div>


    <div class="modal fade" id="createImageModal" tabindex="-1" role="dialog" aria-labelledby="createImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createImageModalLabel">Tambahkan Foto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="/students/image/create" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Masukkan foto</label>
                        <input type="file" name="file" class="form-control-file @error('file') is-invalid-file @enderror"  >
                        @error('file')
                        <div class="invalid-file-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        </div>
      </div>

</div>
@endsection

