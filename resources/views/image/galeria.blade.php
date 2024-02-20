@extends('app')
@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session ('message')}}
                </div>
            @endif
            @foreach($images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach

        </div> 
    </div>
</div>
@endsection