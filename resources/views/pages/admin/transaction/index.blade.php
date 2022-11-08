@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Travel</th>
                          <th>User</th>
                          <th>Visa</th>
                          <th>Vaksin</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @forelse($items as $key => $item)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $item->travel_package->title }}</td>
                              <td>{{ $item->user->name }}</td>
                                @if ($item->additional_visa)
                                    <td>Rp 500.000,00</td>
                                @else
                                    <td>Rp 0</td>
                                @endif
                                @if ($item->additional_vaksin)
                                <td>Rp 500.000,00</td>
                                @else
                                    <td>Rp 0</td>
                                @endif
                              <td>{{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->transaction_total, "IDR") }}</td>
                              <td>
                                @if ($item->transaction_status == 'PENDING')
                                    <span class="badge badge-primary">Pending</span>  
                                @elseif($item->transaction_status == 'SUCCESS')
                                    <span class="badge badge-success">Success</span>
                                @elseif($item->transaction_status == 'CANCEL')
                                    <span class="badge badge-danger">Cancel</span>
                                @elseif($item->transaction_status == 'IN_CART')
                                    <span class="badge badge-secondary">In Cart</span>
                                @else
                                    <span class="badge badge-secondary">{{ $item->transaction_status }}</span>
                                @endif
                              <td>
                                  <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-primary">
                                      <i class="fa fa-eye"></i>
                                  </a>
                                  <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-info">
                                      <i class="fa fa-pencil-alt"></i>
                                  </a>
                                  <form action="{{ route('transaction.destroy', $item->id) }}" method="post" class="d-inline">
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
