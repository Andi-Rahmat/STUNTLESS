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
            <form class="row g-3" action="{{route('pengukuran.store',['id' => $dataBalita->id])}}" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control" id="folaotingTgl" name="tglPengukuran" required>
                    <label for="floatingTgl">tanggal Pengukuran</label>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="berat" readonly name="berat" value="">
                        <label for="floatingEmail">Berat Badan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="tinggi" readonly name="tinggi" value="">
                        <label for="floatingPassword">Tinggi Badan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="suhu" readonly name="suhu" value="">
                        <label for="floatingEmail">Suhu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="lingkarKepala" readonly name="lingkarKepala" value="">
                        <label for="floatingPassword">Lingkar Kepala</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submt</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>
    @endif
    <script>
        flatpickr("#folaotingTgl", {
            maxDate: "today",
            dateFormat: "Y-m-d", // format tanggal
            allowInput: true, // biarkan input manual jika diinginkan
        });

        const berat = document.getElementById('berat');
        const tinggi = document.getElementById('tinggi');
        const suhu = document.getElementById('suhu');
        const lingkarKepala = document.getElementById('lingkarKepala');

        function loadDataPengukuran() {
            $.ajax({
                url: '/get-data-pengukuran', // URL untuk request data
                type: 'GET',
                success: function(response) {
                    berat.value = response.berat
                    tinggi.value = response.tinggi
                    suhu.value = response.suhu;
                    lingkarKepala.value = response.lingkar_kepala;
                },
                error: function() {
                    alert('Failed to retrieve data.');
                }
            });
        }
        setInterval(loadDataPengukuran, 2000);

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