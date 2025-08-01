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
                    <label for="idOrangTua" class="form-label text-sm text-gray-600">
                        <span class="text-sm text-danger">*</span>Silahkan Pilih Balita
                    </label>
                    <select name="idOrangTua" id="idOrangTua" class="selectpicker form-select w-100 p-3 mb-2 border bg-light border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300" style="padding: 20px;">
                        <option value="" selected disabled>Pilih Balita</option>
                        @foreach($balitaList as $balita)
                        <option value="{{ $balita->id }}" {{ old('idOrangTua') == $balita->id ? 'selected' : '' }}>
                            {{ $balita->nik.' - '.$balita->namaLengkap }}
                        </option>
                        @endforeach
                    </select>
                    @error('idOrangTua')
                    <div class="text-danger text-xs">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>
    @if(isset(request()->query('balita')))
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Floating labels Form</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingName" placeholder="Your Name">
                        <label for="floatingName">Your Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email">
                        <label for="floatingEmail">Your Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                        <label for="floatingTextarea">Address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingCity" placeholder="City">
                            <label for="floatingCity">City</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="State">
                            <option selected>New York</option>
                            <option value="1">Oregon</option>
                            <option value="2">DC</option>
                        </select>
                        <label for="floatingSelect">State</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingZip" placeholder="Zip">
                        <label for="floatingZip">Zip</label>
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
                    let url = 'http://127.0.0.1:8000/pengukuran?balita=' + selectedId; // URL dengan id balita
                    window.location.href = url; // Pindah ke URL tersebut
                }
            });
        });
    </script>

</section>
@endsection