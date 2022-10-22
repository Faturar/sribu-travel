<!-- Navbar -->
<div class="container">
  <nav class="row navbar navbar-expand-lg navbar-light bg-white">
    <a href="{{ route('home') }}" class="navbar-brand">
      <img src="{{ url('frontend/images/logo.png') }}" alt="Logo NOMADS" />
    </a>
    <div class="d-flex">
      @guest
        <!-- Mobile Button -->
        <form class="d-sm-block d-md-none mr-4">
          <button class="btn btn-login my-2 my-sm-0" type="button"
                  onclick="event.preventDefault(); location.href='{{ url('login') }}';">
            Masuk
          </button>
        </form>
      @endguest
      @auth
          <!-- Desktop Button -->
          <div class="nav-item dropdown d-sm-block d-md-none list-unstyled">
            <a
              href="#"
              class="nav-link dropdown-toggle text-dark"
              id="navbardrop2"
              data-toggle="dropdown"
            >
              {{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">Pesanan</a>
              <form class="form-inline my-2 my-lg-0" action="{{  url('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </div>
          </div>
      @endauth
      <button
        class="navbar-toggler navbar-toggler-right"
        type="button"
        data-toggle="collapse"
        data-target="#navb"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    

    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item mx-md-2">
          <a href="#" class="nav-link active">Home</a>
        </li>
        <li class="nav-item mx-md-2">
          <a href="/#popular" class="nav-link">Paket Travel</a>
        </li>
        <li class="nav-item mx-md-2">
          <a href="/#umrah" class="nav-link">Paket Umrah</a>
        </li>
        <li class="nav-item mx-md-2">
          <a href="/#testimonialHeading" class="nav-link">Testimoni</a>
        </li>
      </ul>

      @guest
        <!-- Desktop Button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block">
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                  onclick="event.preventDefault(); location.href='{{ url('login') }}';">
            Masuk
          </button>
        </form>
      @endguest

      @auth
          <!-- Desktop Button -->
          <div class="btn btn-login nav-item dropdown list-unstyled">
            <a
              href="#"
              class="nav-link dropdown-toggle text-light"
              id="navbardrop2"
              data-toggle="dropdown"
            >
              {{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu">
              @if (Auth::user()->roles == 'ADMIN' || Auth::user()->roles == 'SUPER_ADMIN')
                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
              @endif
              
              <a href="{{ route('profile', Auth::user()->id) }}" class="dropdown-item">Profile</a>
              
              <a href="{{ route('order', Auth::user()->id) }}" class="dropdown-item">Pesanan</a>
              
              <form class="form-inline my-2 my-lg-0" action="{{  url('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </div>
          </div>
      @endauth

      
    </div>
  </nav>
  
</div>
