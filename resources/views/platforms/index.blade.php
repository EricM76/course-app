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
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                Agregar Plataforma
            </div>
            <div class="card-body">
                <form action="{{route('platforms.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Plataforma</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                        <small class="ms-2 text-danger">
                          {{$message}}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3"></textarea>
                        @error('description')
                        <small class="text-danger ms-2">{{$message}}</small>
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
    <div class="col-12 col-md-8">
        <div class="overflow-auto" style="height: 500px;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plataforma</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($platforms->all() as $platform )
                      <tr>
                        <th scope="row">{{$platform->id}}</th>
                        <td>{{$platform->name}}</td>
                        <td>
                          <a href="{{$platform->link}}" target="_blank"><i class="fa fa-link"></i></a>
                        </td>
                        <td>
                          <div class="d-flex gap-1">
                            <a style="width: 35px" class="btn btn-sm btn-primary" href="{{route('platforms.show',$platform->id)}}"><i class="fas fa-eye"></i></a>
                            <a style="width: 35px" class="btn btn-sm btn-success" href="{{route('platforms.edit',[$platform->id])}}"><i class="fas fa-edit"></i></a>
                            <!-- Button trigger modal -->
                            <button type="button" style="width: 35px" class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#modal-{{$platform->id}}">
                                <i class="fas fa-trash"></i>
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{$platform->id}}" tabindex="-1" aria-labelledby="modal-{{$platform->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-4 text-danger" id="modal-{{$platform->id}}Label">¡Advertencia!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro que desea eliminar la plataforma <strong>{{$platform->name}}</strong>? Se eliminarán todos los cursos que esten vinculados.</p>
                                        <p class="text-danger fw-bold">No podrá revertir los cambios.</p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{route('platforms.destroy',[$platform->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                      </form>
                                    
                                    </div>
                                </div>
                                </div>
                            </div>
  
                            
                            
                           
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