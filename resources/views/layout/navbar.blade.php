<nav class="navbar-nav navbar  navbar-expand-lg navbar-dark bg-dark opacity-75">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('welcome')}}">Notishot</a>
    <button class="navbar-toggler bg-secondary " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class=" collapse navbar-collapse justify-content-end order-last" id="navbarSupportedContent">
        @guest
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
            {{-- <li class="nav-item p-2">
              <a class="nav-link" href="{{ route('image.galeria')}}">Galeria</a>
            </li> --}}
            <li class="nav-item">
              <div class="btn-group dropstart"> 
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Invitado</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                  <li><a class="dropdown-item" href="{{route('registro')}}">Registrarse</a></li>
                </ul>
              </div>
            </li>
          </ul>
        @elseif(Auth::user()->hasrole('lector'))
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="{{ route('image.galeria')}}">Galeria</a>
            </li>
            <li class="nav-item">
              <div class="btn-group dropstart"> 
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="caret">Hola, {{Auth::user()->name}} </span>
                </button>
                <ul class="dropdown-menu">             
                  <li>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="document.getElementById('logout-form').submit()">
                        {{__('Logout')}}</a>
                    <form action="{{route('logout')}}" method="POST" style="display: none">
                        @csrf
                    </form>
                  </li>
                  <li><a href="{{route('user.profile',['id'=> Auth::user()->id])}}" class="dropdown-item" role="button">
                    <span class="caret">Mi Perfil </span></a>     
                  </li>
                  <li><a href="{{route('user.config')}}" class="dropdown-item" role="button">
                      <span class="caret">Configuracion </span></a>     
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        @elseif(Auth::user()->hasrole('redactor'))
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href=" {{ route('image.create')}}">Subir Shots</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href=" {{ route('like.index')}}">Mis Favs </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('image.galeria')}}">Galeria</a>
            </li>
            <li class="nav-item">
              @if(Auth::user()->image != null)
                <div class="container-avatar">
                    <img src="{{ route ('user.avatar',['filename'=>Auth::user()->image]) }}" class="avatar"/>
                </div>
              @endif
            </li>
            <li class="nav-item">
              <div class="btn-group dropstart"> 
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="caret">Hola, {{Auth::user()->name}} </span>
                </button>
                <ul class="dropdown-menu">             
                  <li>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="document.getElementById('logout-form').submit()">
                        {{__('Logout')}}</a>
                    <form action="{{route('logout')}}" method="POST" style="display: none">
                        @csrf
                    </form>
                  </li>
                  <li><a href="{{route('user.profile',['id'=> Auth::user()->id])}}" class="dropdown-item" role="button">
                    <span class="caret">Mi Perfil </span></a>     
                  </li>
                  <li><a href="{{route('user.config')}}" class="dropdown-item" role="button">
                      <span class="caret">Configuracion </span></a>     
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        @elseif(Auth::user()->hasrole('administrador'))
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="{{route('user.admin.list')}}">Listado Usuarios</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="">Listado Shots</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="">Listado Comentarios</a>
            </li>
            <li class="nav-item">
              <div class="btn-group dropstart"> 
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="caret">Hola, {{Auth::user()->name}} </span>
                </button>
                <ul class="dropdown-menu">             
                  <li>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="document.getElementById('logout-form').submit()">
                        {{__('Logout')}}</a>
                    <form action="{{route('logout')}}" method="POST" style="display: none">
                        @csrf
                    </form>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        @endguest
      </div>
  </div>
</nav>
