@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail User {{ $user->name }}</h1>
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
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>

                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ $user->roles }}</td>
                    </tr>
                    <tr>
                        <th>Terferifikasi</th>
                        @if ($user->verified_at != null)
                            <td>{{ $user->verified_at }}</td>
                        @else
                            <td>Belum Terverifikasi</td>
                        @endif
                        

                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $user->created_at }}</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
