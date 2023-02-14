@extends('layouts.app')

@section('title')
  Boza Tour Travel
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
            <h2 class="font-weight-bold">Menu</h2>

            <ul class="navbar-nav mt-3" id="accordionSidebar">
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('profile', Auth::user()->id) }}">
                  <i class="fas fa-fw fa-user mr-2"></i>
                  <span>Profile</span></a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('order', Auth::user()->id) }}">
                  <i class="fas fa-fw fa-credit-card mr-2"></i>
                  <span>Pesanan</span></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 pr-lg-0 mt-3 mt-lg-0">
          <form action="{{ route('profile-update', Auth::user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card card-details">
              <h2 class="font-weight-bold">Edit Profile</h2>
              
              <table class="table table-borderless mt-3">
                <tr>
                  <th class="align-middle" scope="row">Nama</th>
                  <td class="align-middle">:</td>
                  <td class="w-75">
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                  </td>
                </tr>
                <tr>
                  <th class="align-middle" scope="row">Username</th>
                  <td class="align-middle">:</td>
                  <td>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                  </td>
                </tr>
                <tr>
                  <th class="align-middle" scope="row">Nomor Telepon</th>
                  <td class="align-middle">:</td>
                  <td>
                    <input type="text" name="nomor_telepon" class="form-control" value="{{ $user->nomor_telepon }}">
                  </td>
                </tr>
                <tr>
                  <th class="align-middle" scope="row">Email</th>
                  <td class="align-middle">:</td>
                  <td>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                  </td>
                </tr>
                <tr>
                  <th class="align-middle" scope="row">Email Verified</th>
                  <td class="align-middle">:</td>
                  <td>
                    <span class="badge badge-success">
                      @if ($user->email_verified_at != NULL)
                          Verified
                      @else
                          Not Verified
                      @endif
                    </span>
                  </td>
                </tr>
                <tr>
                  <th class=" align-middle" scope="row">Password</th>
                  <td class=" align-middle">:</td>
                  <td>
                    <a href="{{ route('password.request') }}" class="btn btn-secondary">Change Password</a>
                  </td>
                </tr>
              </table>

              <button type="submit" class="btn btn-primary px-5">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection