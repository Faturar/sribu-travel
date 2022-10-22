@extends('layouts.checkout')
@section('title', 'Checkout')

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
                Paket Travel
              </li>
              <li class="breadcrumb-item">
                Detail
              </li>
              <li class="breadcrumb-item active">
                Checkout
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 pl-lg-0">
          <div class="card card-details">
            @if ($errors->any())
              @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>
              @endforeach
            @endif
            <h1>Siapa yang pergi?</h1>
            <p>
              Perjalanan ke Ubud, Bali, Indonesia
            </p>
            <div class="attendee">
              <table class="table table-responsive-sm text-center">
                <thead>
                  <tr>
                    <td>Picture</td>
                    <td>Nama</td>
                    <td>Kebangsaan</td>
                    <td>VISA</td>
                    <td>Paspor</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  @forelse($item->details as $detail)
                      <tr>
                          <td>
                              <img src="https://ui-avatars.com/api/?name={{ $detail->username }}" height="60" class="rounded-circle"/>
                          </td>
                          <td class="align-middle">
                              {{ $detail->username }}
                          </td>
                          <td class="align-middle">
                              {{ $detail->nationality }}
                          </td>
                          <td class="align-middle">
                              {{ $detail->is_visa ? '30 Days' : 'N/A' }}
                          </td>
                          <td class="align-middle">
                              {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Aktif' : 'Tidak Aktif' }}
                          </td>
                          <td class="align-middle">
                              <a href="{{ route('checkout-remove', $detail->id) }}">
                                  <img src="{{ url('frontend/images/ic_remove.png') }}" alt="" />
                              </a>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="6" class="text-center">
                              No Visitor
                          </td>
                      </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="member mt-3">
              <h2>Tambahkan peserta</h2>
              <form class="form-inline my-2" method="post" action="{{ route('checkout-create', $item->id) }}">
                @csrf
                <label for="username" class="sr-only">Name</label>
                <input
                  type="text"
                  name="username"
                  class="form-control mb-2 mr-sm-2"
                  id="inputUsername"
                  placeholder="Username"
                />

              <label for="nationality" class="sr-only">Name</label>
              <input
                  type="text"
                  name="nationality"
                  class="form-control mb-2 mr-sm-2"
                  style="width: 50px;"
                  id="inputNationality"
                  placeholder="Nationality"
              />

                <label for="is_visa" class="sr-only">Visa</label>
                <select
                  name="is_visa"
                  id="inputVisa"
                  class="custom-select mb-2 mr-sm-2"
                  required
                >
                  <option value="" selected>VISA</option>
                  <option value="1">30 Days</option>
                  <option value="0">N/A</option>
                </select>

                <label for="doePassport" class="sr-only"
                  >DOE paspor</label
                >
                <div class="input-group mb-2 mr-sm-2">
                  <input
                    type="text"
                    name="doe_passport"
                    class="form-control datepicker"
                    id="doePassport"
                    placeholder="DOE paspor"
                  />
                </div>

                <button type="submit" class="btn btn-add-now mb-2 px-4">
                  Tambah
                </button>
              </form>
              <h3 class="mt-2 mb-0">Catatan</h3>
              <p class="disclaimer mb-0">
                Anda hanya dapat mengundang peserta yang telah terdaftar.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-details card-right">
            <h2>Informasi Checkout</h2>
            <table class="trip-informations">
              <tr>
                <th width="50%">Peserta</th>
                <td width="50%" class="text-right">
                  {{ $item->details->count() }} orang
                </td>
              </tr>
              <tr>
                <th width="50%">Tambahan VISA</th>
                <td width="50%" class="text-right">
                  {{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->additional_visa, "IDR") }}
                </td>
              </tr>
              <tr>
                <th width="50%">Harga Paket</th>
                <td width="50%" class="text-right">
                  {{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->travel_package->price, "IDR") }} / orang
                </td>
              </tr>
              <tr>
                <th width="50%">Total</th>
                <td width="50%" class="text-right text-total">
                  <span class="text-blue">{{ numfmt_format_currency(numfmt_create( 'id_ID', NumberFormatter::CURRENCY ), $item->transaction_total, "IDR") }}</span>
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
          <div class="join-container">
            <a href="{{ route('checkout-success', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
              Saya Telah Melakukan Pembayaran
            </a>
          </div>
          <div class="text-center mt-3">
            <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">
              Batalkan Pemesanan
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@push('prepend-style')
  <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
  <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        icons: {
          rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" />'
        }
      });
    });
  </script>
@endpush
