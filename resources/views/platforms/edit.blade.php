@extends('app')

@section('content')

<section class="row mt-4">
    <div class="col-12 col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                Editar Plataforma
            </div>
            <div class="card-body">
                <form action="{{route('platforms.update',$platform->id)}}" method="POST" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                
                    <div class="mb-3">
                        <label for="name" class="form-label">Título</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$platform->name}}">
                        @error('name')
                        <small class="ms-2 text-danger">
                          {{$message}}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{$platform->description}}</textarea>
                        @error('description')
                        <small class="text-danger ms-2">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Enlace</label>
                      <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" value="{{$platform->link}}">
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