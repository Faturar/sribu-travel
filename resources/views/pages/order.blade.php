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
        <div class="col-lg-9 pr-lg-0">
          <div class="card card-details">
            <h2 class="font-weight-bold">Pesanan</h2>
              <table class="table table-bordered table-responsive-sm mt-3">    
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
                          <td>{{ $item->travel_package->title }}</td>
                          <td>{{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->additional_visa, "IDR") }}</td>
                          <td>{{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->transaction_total, "IDR") }}</td>
                          <td class="text-center">
                            @if ($item->transaction_status == 'CANCEL')
                                <span class="badge badge-danger">Cancel</span>  
                            @elseif($item->transaction_status == 'SUCCESS')
                                <span class="badge badge-success">Success</span>
                            @elseif($item->transaction_status == 'PENDING')
                              <span class="badge badge-primary">Pending</span>
                            @elseif($item->transaction_status == 'IN_CART')
                              <span class="badge badge-secondary">In Cart</span>
                            @else
                                <span class="badge badge-secondary">{{ $item->transaction_status }}</span>
                            @endif
                          <td class="d-flex">
                              <button onclick="showDetail({{ $item->id }})" class="mr-1 btn btn-primary" data-toggle="modal" data-target="#orderDetail">
                                  <i class="fa fa-eye"></i>
                              </button>
                              <button onclick="showPayment({{ $item->id }})" class="mr-1 btn btn-info" data-toggle="modal" data-target="#payTransaction">
                                  <i class="fa fa-credit-card"></i>
                              </button>
                              <button class="btn btn-danger" data-toggle="modal" data-target="#deleteOrder">
                                <i class="fa fa-times"></i>
                              </button>

                              <!-- Delete Order Modal -->
                              <div class="modal fade bd-example-modal-sm" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="orderDetail" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Batalkan pesanan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="text-center">
                                        <i class="fa fa-times text-danger mt-4" style="font-size: 48px"></i>
                                        <h4 class="mt-4">Yakin ingin membatalkan pesanan?</h4>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <form action="{{ route('order-cancel', $item->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type="text" name="transaction_status" value="CANCEL" hidden>
                                        <button class="btn btn-danger">
                                            Batalkan
                                        </button>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                      </tr>
                    @empty
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    @endforelse 
                  </tbody>
              </table>

              <!-- Detail Modal -->
              <div class="modal fade bd-example-modal-lg" id="orderDetail" tabindex="-1" role="dialog" aria-labelledby="orderDetail" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Detail Pesanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="text-center">
                        <div id="detailSpinner" class="spinner-border text-primary" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                      </div>

                      <table id="detailTable" class="d-none table table-bordered table-responsive-sm">
                        <tr>
                            <th>ID</th>
                            <td id="idDetail"></td>
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
                            <td id="statusTransaction" class="badge ml-2 mt-1"></td>
                        </tr>
                        <tr>
                            <th>Pembelian</th>
                            <td>
                                <table id="details" class="table table-bordered"></table>
                            </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pay Modal -->
              <div class="modal fade bd-example-modal-lg" id="payTransaction" tabindex="-1" role="dialog" aria-labelledby="orderDetail" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="text-center">
                        <div id="paymentSpinner" class="spinner-border text-primary" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                      </div>

                      <div class="card card-details card-right">
                        <h2>Informasi Pembayaran</h2>
                        <table id="paymentTable" class="trip-informations">
                          <tr>
                            <th width="50%">Peserta</th>
                            <td id="memberPayment" width="50%" class="text-right"></td>
                          </tr>
                          <tr>
                            <th width="50%">Tambahan VISA</th>
                            <td id="visaPayment" width="50%" class="text-right"></td>
                          </tr>
                          <tr>
                            <th width="50%">Harga Paket</th>
                            <td id="packagePayment" width="50%" class="text-right"></td>
                          </tr>
                          <tr>
                            <th width="50%">Total</th>
                            <td width="50%" class="text-right text-total">
                              <span id="totalPayment" class="text-blue"></span>
                            </td>
                          </tr>
                        </table>
            
                        <hr />
                        <h2>Instruksi pembayaran</h2>
                        <p class="payment-instructions">
                          Harap selesaikan pembayaran Anda sebelum melanjutkan perjalanan yang menyenangkan
                        </p>
                        <div class="bank">
                          <div class="bank-item pb-3">
                            <img
                              src="{{ url('frontend/images/ic_bank.png') }}"
                              alt=""
                              class="bank-image"
                            />
                            <div class="description">
                              <h3>PT Nomads ID</h3>
                              <p>
                                0881 8829 8800
                                <br />
                                Bank Central Asia
                              </p>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="bank-item pb-3">
                            <img
                              src="{{ url('frontend/images/ic_bank.png') }}"
                              alt=""
                              class="bank-image"
                            />
                            <div class="description">
                              <h3>PT Nomads ID</h3>
                              <p>
                                0899 8501 7888
                                <br />
                                Bank HSBC
                              </p>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="paymentButton" type="button" onclick="transactionPayment()" class="btn btn-primary">
                        Saya Telah Melakukan Pembayaran
                      </button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      // Detail Element
      const detailTable = document.getElementById('detailTable');
      const idDetail = document.getElementById('idDetail');
      const paketTravelDetail = document.getElementById('paketTravelDetail');
      const userName = document.getElementById('userName');
      const addVisa = document.getElementById('addVisa');
      const totalTransaction = document.getElementById('totalTransaction');
      const statusTransaction = document.getElementById('statusTransaction');
      const detailsTable = document.getElementById('details');
      
      const detailSpinner = document.getElementById('detailSpinner');
      
      // Payment Element
      const paymentTable = document.getElementById('paymentTable');
      const memberPayment = document.getElementById('memberPayment');
      const visaPayment = document.getElementById('visaPayment');
      const packagePayment = document.getElementById('packagePayment');
      const totalPayment = document.getElementById('totalPayment');
      const paymentButton = document.getElementById('paymentButton');
      
      const paymentSpinner = document.getElementById('paymentSpinner');

      function showDetail(id) {
        const url = `/order/detail/${id}`
        fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
          const {id, additional_visa, transaction_total, transaction_status, details,
            travel_package, user} = data.detail[0];

          detailTable.classList.remove('d-none');
          detailSpinner.classList.add('d-none');

          // Pass data to transaction detail table
          //Detail ID
          idDetail.innerText = id
          
          // Paket travel
          paketTravelDetail.innerText = travel_package.title;
          
          // Username
          userName.innerText = user.name;
          
          // Additional visa
          if(additional_visa) {
            addVisa.innerText = "30 Days";
          } else {
            addVisa.innerText = "N/A";
          }
          
          // Total Transaction
          totalTransaction.innerText = transaction_total.toLocaleString("id-ID", {style:"currency", currency:"IDR"});
          
          // Transaction status
          if(transaction_status == "PENDING") {
            statusTransaction.classList.add('badge-danger');
          } else if (transaction_status == "SUCCESS") {
            statusTransaction.classList.add('badge-success');
          } else {
            statusTransaction.classList.add('badge-secondary');
          }
          
          statusTransaction.innerText = transaction_status;


          // User Details Table
          detailsTable.innerHTML = '';
          detailsTable.innerHTML = `
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Nationality</th>
              <th>Visa</th>
              <th>Vaksin</th>
              <th>DOE Passport</th>
            </tr>`;

          // Rendering User Data
          details.forEach(detail => {
            detailsTable.innerHTML += `
              <tr>
                <td>${detail.id}</td>
                <td>${detail.username}</td>
                <td>${detail.nationality}</td>
                <td>${detail.is_visa ? '30 Days' : 'N/A'}</td>
                <td>${detail.is_visa ? '30 Days' : 'N/A'}</td>
                <td>${detail.doe_passport}</td>
              </tr>
            `
          });
        });
      }

      function showPayment(id) {
        const url = `/order/detail/${id}`
        fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
          const {id, details, additional_visa, transaction_total, travel_package} = data.detail[0];

          paymentTable.classList.remove('d-none');
          paymentSpinner.classList.add('d-none');

          // Pass data to transaction detail table
          // Member payment
          memberPayment.innerText = details.length + ' orang';
          
          // visaPayment
          visaPayment.innerText = 'Rp. ' + additional_visa;

          // Package payment
          packagePayment.innerText = travel_package.price.toLocaleString("id-ID", {style:"currency", currency:"IDR"});
          
          // Total Transaction
          totalPayment.innerText = transaction_total.toLocaleString("id-ID", {style:"currency", currency:"IDR"});

          // Payment button value
          paymentButton.value = id;
        });
      }
      

      function transactionPayment() {
        const url = `/checkout/confirm/${paymentButton.value}`;
        
        window.location.href = url;
      }
    </script>
@endpush