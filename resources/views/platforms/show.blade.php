@extends('app')

@section('content')

<section class="row mt-5">
    <article class="col-12 col-md-6 mx-auto">
        <div class="card mb-3">
            <img src="{{asset(Storage::disk('public')->url($platform->image))}}" width="100px" class="mx-auto mt-3" alt="...">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">{{$platform->name}}</h4>
                    <a href="{{$platform->link}}" target="_blank"><i class="fa fa-link"></i></a>
                </div>
                
               
                <p class="card-text">{{$platform->description}}</p>
                <hr>
                <h5>Cursos</h5>
                @if ($platform->courses->count() > 0)
                <div class="list-group">
                    @foreach ($platform->courses as $course)
                    <a href="{{route('courses-show',$course->id)}}" class="list-group-item list-group-item-action">
                        {{$course->title}}
                      </a>
                    @endforeach
                   
                 
                  </div>
                @else
                    <p class="alert alert-warning">Aún no hay cursos vinculados con esta plataforma.</p>
                @endif
                
            </div>
        </div>
        </div>
    </article>
     

</section>
@endsection