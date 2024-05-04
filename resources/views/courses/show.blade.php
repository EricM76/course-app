@extends('app')

@section('content')

<section class="row mt-5">
    <article class="col-12 col-md-6 mx-auto">
        <div class="card mb-3">
            <img src="{{asset(Storage::disk('public')->url($course->image))}}" width="200px" class="mx-auto mt-3" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$course->title}}</h5>
                <hr>
                <p class="card-text">{{$course->description}}</p>
                
            </div>
        </div>
        </div>
    </article>
     

</section>
@endsection