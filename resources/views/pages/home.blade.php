@extends('layouts.app')

@section('title')
  Sribu Tour Travel
@endsection

@section('content')
<!-- Header -->
<header class="text-center">
  <h1>
    Buat liburan dan umrah anda
    <br> 
    lebih menyenangkan
  </h1>
  <p class="mt-3">
    Anda akan melihat momen 
    <br>
    yang belum pernah anda lihat sebelumnya
  </p>
  <a href="#popular" class="btn btn-get-started px-4 mt-4">
    Mulai Sekarang
  </a>
</header>

<main>
  <div class="container">
    <section class="section-stats row justify-content-center rounded" id="stats">
      <div class="col-3 col-md-2 stats-detail">
        <h2>20K</h2>
        <p>Anggota</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>12</h2>
        <p>Negara</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>3K</h2>
        <p>Hotel</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>72</h2>
        <p>Mitra</p>
      </div>
    </section>
  </div>

  <section class="section-popular" id="popular">
    <div class="container">
      <div class="row">
        <div class="col text-center section-popular-heading">
          <h2>Paket Wisata</h2>
          <p>
            Sesuatu yang tidak pernah kamu coba
            <br>
            sebelumnya di dunia ini
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-popular-content" id="popularContent">
    <div class="container">
      <div class="section-popular-travel row justify-content-center">
        @foreach($items as $item)
          @if ($item->category == 'Travel') 
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div
                class="card-travel text-center d-flex flex-column"
                style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');"
              >
                <div class="travel-country">{{ $item->location }}</div>
                <div class="travel-location">{{ $item->title }}</div>
                <div class="travel-button mt-auto">
                  <a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-details px-4">
                    Selengkapnya
                  </a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </section>

  <section class="section-umrah" id="umrah">
    <div class="container">
      <div class="row">
        <div class="col text-center section-umrah-heading">
          <h2>Paket Umrah</h2>
          <p>
            Pengalaman nyaman beribadah yang belum <br>pernah kamu rasakan sebelumnya
          </p>
        </div>
      </div>
    </div> 
  </section>

  <section class="section-umrah-content" id="umrahContent">
    <div class="container">
      <div class="section-umrah-travel row justify-content-center">
        @foreach($items as $item)
          @if ($item->category == 'Umrah')
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div
                class="card-travel text-center d-flex flex-column"
                style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');"
              >
                <div class="travel-country">{{ $item->location }}</div>
                <div class="travel-location">{{ $item->title }}</div>
                <div class="travel-button mt-auto">
                  <a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-details px-4">
                    Selengkapnya
                  </a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </section>

  <section class="section-networks" id="networks">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2>Jaringan kami</h2>
          <p>
            Perusahaan mempercayai kami
            lebih dari sekedar perjalanan
          </p>
        </div>
        <div class="col-md-8 text-center">
          <img
            src="frontend/images/partner.png"
            alt="Logo Partner"
            class="img-partner"
          />
        </div>
      </div>
    </div>
  </section>

  <section class="section-testimonial-heading" id="testimonialHeading">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2>Mereka Mencintai Kita</h2>
          <p>
            Saat-saat memberi mereka
            <br />
            pengalaman terbaik
          </p>
        </div>
      </div>
    </div>
  </section>

  <section
    class="section section-testimonial-content"
    id="testimonialContent"
  >
    <div class="container">
      <div class="section-popular-travel row justify-content-center">
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testiominal-content">
              <img
                src="frontend/images/testimonial-1.png"
                alt="User"
                class="mb-4 rounded-circle"
              />
              <h3 class="mb-4">Ahmad Sofian</h3>
              <p class="testimonial">
                “ Pengalaman beribadah yang sangat menyenangkan bersama  “
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Perjalanan Umrah
            </p>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testiominal-content">
              <img
                src="frontend/images/testimonial-2.png"
                alt="User"
                class="mb-4 rounded-circle"
              />
              <h3 class="mb-4">Shayna</h3>
              <p class="testimonial">
                “ Perjalanannya luar biasa dan saya melihat sesuatu yang indah di pulau itu yang membuat saya ingin belajar lebih banyak “
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Perjalanan ke Nusa Penida
            </p>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testiominal-content">
              <img
                src="frontend/images/testimonial-3.png"
                alt="User"
                class="mb-4 rounded-circle"
              />
              <h3 class="mb-4">Rossa</h3>
              <p class="testimonial">
                “ Saya menyukainya ketika ombak berguncang lebih keras — tapi saya juga takut “
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Perjalanan ke Karimun Jawa
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <a href="#" class="btn btn-need-help px-4 mt-4 mx-1">
            Butuh Bantuan
          </a>
          <a href="{{ route('register') }}" class="btn btn-get-started px-4 mt-4 mx-1">
            Mulai Sekarang
          </a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
