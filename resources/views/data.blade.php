@extends('sidebar')
@section('title', 'Grafik')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Data {{ $criterias[0]->year->year }}</h6>
          </div>
        </div>
        <div class="card-body">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pilih Tahun
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/data/1">2018</a></li>
              <li><a class="dropdown-item" href="/data/2">2019</a></li>
              <li><a class="dropdown-item" href="/data/3">2020</a></li>
              <li><a class="dropdown-item" href="/data/4">2021</a></li>
              <li><a class="dropdown-item" href="/prediksi">Prediksi</a></li>
            </ul>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">No.</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Nama Kecamatan</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Jumlah Kasus</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Jumlah Meninggal</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Kepadatan Penduduk</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Desa SBS</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Desa STBM</th>
                  <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Curah Hujan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($criterias as $criteria)
                <tr>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $loop->iteration }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->subdistrict->name }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->case }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->death }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->population_density }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->desa_sbs }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->desa_stbm }}</p>
                    </td>
                    <td>
                      <p class="font-weight-normal text-sm text-secondary mb-0">{{ $criteria->rainfall }}</p>
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