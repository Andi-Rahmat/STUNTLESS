@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')
<div class="pagetitle">
    <h1>Pengukuran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Pengukuran</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
            </div>
            <form action="GET" class="row">
                <div class="mb-4">
                    <label for="idBalita" class="form-label text-sm text-gray-600">
                        <span class="text-sm text-danger">*</span>Silahkan Pilih Balita
                    </label>
                    <select name="idBalita" id="idBalita" class="selectpicker form-select w-100 p-3 mb-2 border bg-light border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300" style="padding: 20px;">
                        <option value="" selected disabled>Pilih Balita</option>
                        @foreach($balitaList as $balita)
                        <option value="{{ $balita->id }}" {{ old('idBalita') == $balita->id ? 'selected' : '' }} {{ request()->query('balita') == $balita->id ? 'selected' : '' }}>
                            {{ $balita->nik.' - '.$balita->namaLengkap }}
                        </option>
                        @endforeach
                    </select>
                    @error('idBalita')
                    <div class="text-danger text-xs">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>
    @if(request()->query('balita') !== null)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$dataBalita->namaLengkap .' - '. hitungUsia($dataBalita->tglLahir)}}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Your Email" value="{{$dataIot->berat}}">
                        <label for="floatingEmail">Berat Badan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password" value="{{$dataIot->tinggi}}">
                        <label for="floatingPassword">Tinggi Badan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Your Email" value="{{$dataIot->suhu}}">
                        <label for="floatingEmail">Suhu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password" value="{{$dataIot->lingkar_kepala}}">
                        <label for="floatingPassword">Lingkar Kepala</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>
    @endif
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen select
            $('.selectpicker').select2();

            // Event handler ketika nilai select berubah
            $('.selectpicker').on('change', function() {
                let selectedId = $(this).val(); // Ambil nilai yang dipilih
                if (selectedId) { // Pastikan ada id yang dipilih
                    let url = '/admin/pengukuran-balita?balita=' + selectedId; // URL dengan id balita
                    window.location.href = url; // Pindah ke URL tersebut
                }
            });
        });
    </script>

</section>
@endsection