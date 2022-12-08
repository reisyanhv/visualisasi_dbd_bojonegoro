@extends('sidebar')
@section('title', 'Grafik')
@section('content')
<div class="container-fluid py-4">
  <div class="row mb-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h5>Informasi DBD</h5>
              <h6 class="mb-0">Pengertian</h6>
              <p class="text-sm">
                Demam berdarah dengue atau DBD merupakan penyakit mudah menular yang berasal dari gigitan nyamuk Aedes aegypti dan Aedes albopictus. Penyakit ini disebabkan oleh salah satu dari empat virus dengue.
              </p>
              <h6 class="mb-0">Gejala</h6>
              <ul class="text-sm">
                <li>Demam tinggi mencapai 40 derajat Celsius</li>
                <li>Nyeri pada sendi, otot, dan tulang</li>
                <li>Ruam kemerahan sekitar 2–5 hari setelah demam</li>
              </ul>
              <h6 class="mb-0">Pencegahan</h6>
              <ul class="text-sm">
                <li>Memberantas sarang nyamuk yang dilakukan dalam dua kali pengasapan insektisida atau fogging dengan jarak 1 minggu</li>
                <li>Menguras tempat penampungan air, seperti bak mandi, minimal setiap minggu</li>
                <li>Menaburkan bubuk larvasida (abate) pada penampungan air yang sulit dikuras</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Aedes Aegypti</h6>
          <img src="../assets/img/nyamukdbd.jpg" class="img-fluid">
        </div>
      </div>

    </div>
  </div>
</div>
@endsection