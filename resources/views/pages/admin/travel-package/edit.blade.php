@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Paket Travel {{ $item->title }}</h1>
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
                <form action="{{ route('travel-package.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul Paket</label>
                        <input type="text" class="form-control" name="title" placeholder="Judul Paket" value="{{ $item->title }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Lokasi/Negara/Kota</label>
                        <input type="text" class="form-control" name="location" placeholder="Lokasi/Negara/Kota" value="{{ $item->location }}">
                    </div>
                    <div class="form-group">
                        <label for="about">Tentang Paket</label>
                        <textarea name="about" id="editor">{{ $item->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="featured_event">Event Utama</label>
                        <input type="text" class="form-control" name="featured_event" placeholder="Event Utama" value="{{ $item->featured_event }}">
                    </div>
                    <div class="form-group">
                        <label for="language">Bahasa</label>
                        <input type="text" class="form-control" name="language" placeholder="Bahasa" value="{{ $item->language }}">
                    </div>
                    <div class="form-group">
                        <label for="foods">Makanan</label>
                        <input type="text" class="form-control" name="foods" placeholder="Makanan" value="{{ $item->foods }}">
                    </div>
                    <div class="form-group">
                        <label for="departure_date">Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" name="departure_date" placeholder="Tanggal Keberangkatan" value="{{ $item->departure_date }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi Perjalanan</label>
                        <input type="text" class="form-control" name="duration" placeholder="Durasi Perjalanan" value="{{ $item->duration }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe Perjalanan</label>
                        <select class="form-control" name="type" id="category">
                            <option value="{{ $item->type }}" selected>Tipe Perjalanan ({{ $item->type }})</option>
                            <option value="Perjalanan Terbuka">Perjalanan Terbuka</option>
                            <option value="Perjalanan Pribadi">Perjalanan Pribadi</option>
                            <option value="Paket Wisata Rombongan">Paket Wisata Rombongan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select class="form-control" name="category" id="category">
                            <option value="{{ $item->category }}">Kategori ({{ $item->category }})</option>
                            <option value="Travel">Travel</option>
                            <option value="Umrah">Umrah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control" name="price" placeholder="Harga" value="{{ $item->price }}">
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

@push('addon-script')
    {{-- CK editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                placeholder: 'Tentang Paket',
                htmlEmbed: {
                    showPreviews: true
                },
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>    
@endpush