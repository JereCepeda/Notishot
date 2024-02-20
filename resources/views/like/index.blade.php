@extends('app')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card d-flex">
                <div class=" row justify-content-center h1" style="calc(var(--bs-gutter-x) * .5);">Mis Noticias Favoritas </div>
                @foreach($likes as $like)
                    @include('includes.image',['image'=>$like->image])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection