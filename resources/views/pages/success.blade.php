@extends('layouts.success')
@section('title', 'Checkout Success - Boza Tour Travel')

@section('content')
<main>
  <div class="section-success d-flex align-items-center">
    <div class="col text-center">
      <img src="{{ url('frontend/images/ic_mail.png') }}" alt="" />
      <h1>Yay! Berhasil</h1>
      <p>
        Kami telah mengirimi Anda email untuk instruksi perjalanan
        <br />
        silahkan dibaca
      </p>

      <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">
        Home Page
      </a>
      <a href="{{ route('order', Auth::user()->id) }}" class="btn btn-secondary mt-3 px-5">
        Pesanan
      </a>
    </div>
  </div>
</main>
@endsection