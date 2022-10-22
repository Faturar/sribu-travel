@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
          <a href="{{ route('travel-package.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
          </a>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Lokasi</th>
                          <th>Tipe Perjalanan</th>
                          <th>Tanggal Berangkat</th>
                          <th>Tipe Perjalanan</th>
                          <th>Kategori</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @forelse($items as $key => $item)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $item->title }}</td>
                              <td>{{ $item->location }}</td>
                              <td>{{ $item->type }}</td>
                              <td>{{ $item->departure_date }}</td>
                              <td>{{ $item->type }}</td>
                              <td>{{ $item->category }}</td>
                              <td>
                                  <a href="{{ route('travel-package.edit', $item->id) }}" class="btn btn-info">
                                      <i class="fa fa-pencil-alt"></i>
                                  </a>
                                  <form action="{{ route('travel-package.destroy', $item->id) }}" method="post" class="d-inline">
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
