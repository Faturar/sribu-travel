@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-users-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah User {{ $user->username }}</h1>
      </div>

      <!-- Content Row -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select class="custom-select" name="roles" id="roles">
                            <option value="{{ $user->roles }}">Pilih Role ({{ $user->roles }})</option>
                            <option value="USER">User</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password_change" placeholder="Kosongan jika tidak mau ganti password">
                        <input type="hidden" class="form-control" value="{{ $user->password }}" name="password" placeholder="Kosongan jika tidak mau ganti password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection