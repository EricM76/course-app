@extends('app')

@section('content')

<section class="row mt-4">
  @if (session('success'))

  <div class="col-12">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
   {{session('success')}}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
</div>
  @endif
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-header">
                Nuevo Curso
            </div>
            <div class="card-body">
                <form action="{{route('courses')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                        @error('title')
                        <small class="ms-2 text-danger">
                          {{$message}}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="2"></textarea>
                        @error('description')
                        <small class="text-danger ms-2">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="platform" class="form-label">Plataforma</label>
                      <select name="platform" class="form-select @error('platform') is-invalid @enderror" id="platform">
                        <option selected hidden>Seleccione...</option>
                        @foreach ($plataforms as $plataform)
                        <option value="{{$plataform->id}}">{{$plataform->name}}</option>
                        @endforeach
                      </select>
                      @error('platform')
                      <small class="ms-2 text-danger">
                        {{$message}}
                      </small>
                      @enderror
                  </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Enlace</label>
                      <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link">
                      @error('link')
                      <small class="ms-2 text-danger">
                        {{$message}}
                      </small>
                      @enderror
                  </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="formFile" name="file">
                    </div>
                    <div>
                        <button class="btn btn-dark w-100" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="overflow-auto" style="height: 500px;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($courses->all() as $course )
                      <tr>
                        <th scope="row">{{$course->id}}</th>
                        <td>{{$course->title}}</td>
                        <td>
                          <a href="{{$course->link}}" target="_blank"><i class="fa fa-link"></i></a>
                        </td>
                        <td>
                          <div class="d-flex gap-1">
                            <a style="width: 35px" class="btn btn-sm btn-primary" href="{{route('courses-show',['id' => $course->id])}}"><i class="fas fa-eye"></i></a>
                            <a style="width: 35px" class="btn btn-sm btn-success" href="{{route('courses-edit',[$course->id])}}"><i class="fas fa-edit"></i></a>
                            <form action="{{route('courses-delete',[$course->id])}}" method="POST">
                              @method('DELETE')
                              @csrf
                            <button style="width: 35px" class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    
                    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

</section>
@endsection