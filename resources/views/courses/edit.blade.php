@extends('app')

@section('content')

<section class="row mt-4">
    <div class="col-12 col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                Editar Curso
            </div>
            <div class="card-body">
                <form action="{{route('courses-update',$course->id)}}" method="POST" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf

                   @if (session('success'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                     
                   @endif

                
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{$course->title}}">
                        @error('title')
                        <small class="ms-2 text-danger">
                          {{$message}}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{$course->description}}</textarea>
                        @error('description')
                        <small class="text-danger ms-2">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="platform" class="form-label">Plataforma</label>
                        <select name="platform" class="form-select @error('platform') is-invalid @enderror" id="platform">
                          @foreach ($platforms as $platform)
                          <option value="{{$platform->id}}"
                            @if ($platform->id == $course->platform_id)
                                selected
                            @endif
                            
                            >{{$platform->name}}</option>
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
                      <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" value="{{$course->link}}">
                      @error('link')
                      <small class="ms-2 text-danger">
                        {{$message}}
                      </small>
                      @enderror
                  </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                    <div>
                        <button class="btn btn-dark w-100" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</section>
@endsection