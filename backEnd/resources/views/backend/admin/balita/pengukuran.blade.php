@extends('backend.layouts.app')

@section('title','pengukuran - STUNTLESS')
@section('content')
<div class="pagetitle">
    <h1>Pengukuran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{cekRole()}}/dashboard">Home</a></li>
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
            <div class="text-start mb-3">
                <a href="{{route('registrasi.balita',['role' => cekRole()])}}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Balita
                </a>
            </div>
        </div>
    </div>
    @if(request()->query('balita') !== null)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$dataBalita->namaLengkap .' - '. hitungUsia($dataBalita->tglLahir)}}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 d-flex align-items-center" action="{{route('pengukuran.store',['id' => $dataBalita->id])}}" method="post">
                @csrf
                <div class="row d-flex align-items-start mt-3 justify-content-center">
                    <div class="col-7">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="folaotingTgl" name="tglPengukuran" required>
                            <label for="floatingTgl">tanggal Pengukuran</label>
                        </div>
                    </div>
                    <div class="col-5">
                        <p class="card-title py-0">usia : <span id="usiaPengukuran">Silahkan pilih tgl Terlebih dahulu!!!</span></p>
                    </div>
                    <div class="col-12 col-md-7 mt-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="berat" name="berat" value="">
                                    <label for="floatingEmail">Berat Badan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tinggi" name="tinggi" value="">
                                    <label for="floatingPassword">Tinggi Badan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="suhu" name="suhu" value="">
                                    <label for="floatingEmail">Suhu</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lingkarKepala" name="lingkarKepala" value="">
                                    <label for="floatingPassword">Lingkar Kepala</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mt-3">
                        <div class="card-title py-0">hasil capture : </div>
                        <div class="text-center">
                            <img id="imgLingkarKepala" class="img-fluid rounded shadow" alt="Capture Kepala" style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>
    <script>
        // Fungsi untuk menghitung usia
        const dateInput = document.getElementById('folaotingTgl');
        const birthDate = new Date("{{$dataBalita->tglLahir}}");

        dateInput.addEventListener('change', () => {
            const selectedDate = new Date(dateInput.value);
            let ageYears = selectedDate.getFullYear() - birthDate.getFullYear();
            let ageMonths = selectedDate.getMonth() - birthDate.getMonth();

            // Jika bulan lahir lebih besar dari bulan yang dipilih, kurangi tahun dan tambahkan bulan
            if (ageMonths < 0) {
                ageYears--;
                ageMonths += 12;
            }
            document.getElementById('usiaPengukuran').innerText = `${ageYears} tahun ${ageMonths} bulan`;
        });

        flatpickr("#folaotingTgl", {
            maxDate: "today",
            dateFormat: "Y-m-d", // format tanggal
            allowInput: true, // biarkan input manual jika diinginkan
        });

        const berat = document.getElementById('berat');
        const tinggi = document.getElementById('tinggi');
        const suhu = document.getElementById('suhu');
        const lingkarKepala = document.getElementById('lingkarKepala');
        const imgLingkarKepala = document.getElementById('imgLingkarKepala');

        function loadDataPengukuran() {
            $.ajax({
                url: '/get-data-pengukuran', // URL untuk request data
                type: 'GET',
                success: function(response) {
                    berat.value = response.berat
                    tinggi.value = response.tinggi
                    suhu.value = response.suhu;
                    lingkarKepala.value = response.lingkarKepala;
                    imgLingkarKepala.setAttribute('src', response.imgLingkarKepala + '?t=' + new Date().getTime());
                },
                error: function() {
                    alert('Failed to retrieve data.');
                }
            });
        }
        setInterval(loadDataPengukuran, 3000);
    </script>
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