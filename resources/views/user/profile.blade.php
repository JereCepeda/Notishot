@extends('app')
@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8 p-0">
            <div class="profile-user">
                @if($user->image)
                    <div class="container-avatar container-profile ">
                        <img src="{{route ('user.avatar',['filename'=>$user->image])}}" class="avatar">
                    </div>
                @endif
                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '. $user->surname}}</h2>
                    <p>{{'Su rol en Notishot es : '.$user->role}}</p>
                </div>
            </div>
            <hr>
            @foreach($user->images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach
        </div> 
    </div>
</div>
@endsection