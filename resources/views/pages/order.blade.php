@extends('layouts.app')

@section('title')
SRIBU
@endsection

@section('content')
@csrf
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
                Pesanan
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
        <div class="col-lg-9 pr-lg-0">
          <div class="card card-details">
            <h2 class="font-weight-bold">Pesanan</h2>
              <table class="table table-bordered mt-3">    
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Paket</th>
                        <th>Tambahan VISA</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($items as $key => $item)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>a{{ $item->travel_package->title }}</td>
                          <td>Rp. {{ $item->additional_visa }}</td>
                          <td>Rp. {{ $item->transaction_total }}</td>
                          <td>
                            @if ($item->transaction_status == 'PENDING')
                                <span class="badge badge-danger">Pending</span>  
                            @elseif($item->transaction_status == 'SUCCESS')
                                <span class="badge badge-success">Success</span>
                            @else
                                <span class="badge badge-secondary">{{ $item->transaction_status }}</span>
                            @endif
                          <td>
                              <button onclick="fetchDetail({{ $item->id }})" class="btn btn-primary" data-toggle="modal" data-target="#orderDetail">
                                  <i class="fa fa-eye"></i>
                              </button>
                              <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-info">
                                  <i class="fa fa-credit-card"></i>
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

              <!-- Modal -->
              <div class="modal fade" id="orderDetail" tabindex="-1" role="dialog" aria-labelledby="orderDetail" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th>Paket Travel</th>
                            <td id="paketTravelDetail"></td>
                        </tr>
                        <tr>
                            <th>Pembeli</th>
                            <td id="userName"></td>
                        </tr>
                        <tr>
                            <th>Additional Visa</th>
                            <td id="addVisa">Rp. </td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td id="totalTransaction">Rp. </td>
                        </tr>
                        <tr>
                            <th>Status Transaksi</th>
                            <td id="statusTransaction"></td>
                        </tr>
                        <tr>
                            <th>Pembelian</th>
                            <td>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Nationality</th>
                                        <th>Visa</th>
                                        <th>DOE Passport</th>
                                    </tr>
                                    {{-- @foreach($item->details as $detail)
                                        <tr>
                                            <td>{{ $detail->id }}</td>
                                            <td>{{ $detail->username }}</td>
                                            <td>{{ $detail->nationality }}</td>
                                            <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                            <td>{{ $detail->doe_passport }}</td>
                                        </tr>
                                    @endforeach --}}
                                </table>
                            </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@push('addon-script')
    <script>
      const paketTravelDetail = document.getElementById('paketTravelDetail');
      const userName = document.getElementById('userName');
      const addVisa = document.getElementById('addVisa');
      const totalTransaction = document.getElementById('totalTransaction');
      const statusTransaction = document.getElementById('statusTransaction');
      
      function fetchDetail(id) {
        const url = `/order/detail/${id}`
        fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then((response) => response.json())
        .then((data) => console.log(data.detail[0]));
      }
    </script>
@endpush