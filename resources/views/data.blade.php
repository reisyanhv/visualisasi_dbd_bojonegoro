@extends('sidebar')
@section('title', 'Grafik')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Data</h6>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">No.</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">Nama Kecamatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subdistricts as $subdistrict)
                <tr>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{ $subdistrict->name }}</p>
                    </td>
                </tr>
        @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection