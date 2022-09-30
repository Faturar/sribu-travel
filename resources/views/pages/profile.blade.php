@extends('layouts.app')

@section('title')
SRIBU
@endsection

@section('content')
<main>
  <section class="section-details-header"></section>
  <section class="section-details-content">
    <div class="container">
      <div class="row">
        <div class="col p-0">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                Dashboard
              </li>
              <li class="breadcrumb-item active">
                Profile
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        {{-- Sidebar --}}
        <div class="col-lg-3 pl-lg-0">
          <div class="card card-details">
            <h2 class="font-weight-bold">Dashboard</h2>

            <ul class="navbar-nav mt-3" id="accordionSidebar">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('profile', Auth::user()->id) }}">
                  <i class="fas fa-fw fa-user"></i>
                  <span>Profile</span></a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="{{ route('order', Auth::user()->id) }}">
                  <i class="fas fa-fw fa-credit-card"></i>
                  <span>Pesanan</span></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 pr-lg-0">
          <div class="card card-details">
            <h2 class="font-weight-bold">Profile</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection