@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
          <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah User
          </a>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Verified</th>
                          <th>Roles</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @forelse($items as $key => $item)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->username }}</td>
                              <td>{{ $item->email }}</td>
                              <td>
                                @if ($item->email_verified_at)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-danger">Not Verified</span>
                                @endif
                              </td>
                              <td>
                                @if ($item->roles == 'ADMIN')
                                    <span class="badge badge-primary">Admin</span>
                                @else
                                    <span class="badge badge-secondary">User</span>
                                @endif
                              </td>
                              <td>
                                  <a href="{{ route('user.show', $item->id) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                  <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info">
                                      <i class="fa fa-pencil-alt"></i>
                                  </a>
                                  <form action="{{ route('user.destroy', $item->id) }}" method="post" class="d-inline">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-danger">
                                          <i class="fa fa-trash"></i>
                                      </button>
                                  </form>

                              </td>
                          </tr>
                      @empty
                          <td colspan="7" class="text-center">
                              Data Kosong
                          </td>
                      @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
    <!-- /.container-fluid -->
@endsection
