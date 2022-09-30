@extends('layouts.app')

@section('title')
SRIBU
@endsection

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
              <table>    
                  <thead>
                    <tr>
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
                              <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-primary">
                                  <i class="fa fa-eye"></i>
                              </a>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section></section>
</main>
@endsection