<div class="card pub_image">
    <div class="card-header">
        <div class="container-avatar">
            <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
        </div>
        <div class="data-user">
            <a style="text-decoration: none !important;color:black !important;" href="{{ route('user.profile',['id'=>$image->user->id])}}">
            &nbsp; {{$image->user->name.' '.$image->user->surname.' | @'.$image->user->nick}}
        </div>
    </div>
    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.Get_detail',['id'=>$image->id])}}" >
                <img src="{{ route('image.Get_img',['filename'=>$image->image_path])}}">
            </a>
        </div>
        <div class="likes" id="tegusta">
            @php
                $user_like = false;
                $user = Auth::user();
                foreach($image->likes as $like){
                    if($user)
                        if($like->user->id == $user->id)
                            {$user_like = true;}
                }
            @endphp
            @if ($user_like)
                <button type="button" data-env="{{env('APP_URL')}}" data-id="{{ $image->id }}" class="btn btn-dislike p-2"><i class="bi bi-heart-fill" style="color:red" ></i></button>
            @elseif($user && $user->can('publicacion.like'))
                <button type="button" data-env="{{env('APP_URL')}}" data-id="{{ $image->id }}" class="btn btn-like p-2"><i class="bi bi-heart-fill" ></i></button>
            @else
                <img src="{{ url('storage/img/heartgray.png')}}"/>
            @endif
            <span class="number_likes">
                {{count($image->likes)}}
            </span>
        </div>
        <div class="description">
            <span class="nickname">{{"@".$image->user->nick .' | '. \FormatTime::LongTimeFilter($image->created_at)}}</span> 
            <p>{{$image->description}}</p>
        </div>
        <a href="{{ route('image.Get_detail',['id'=>$image->id])}}" class="btn btn-sm btn-warning comentarios">
            Comentarios ({{count($image->comments)}})
        </a>
    </div>
</div>