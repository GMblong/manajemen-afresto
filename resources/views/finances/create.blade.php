@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Finance</h2>
    <form method="POST" action="{{ route('finances.store') }}">
        @csrf
        <div class="form-group">
            <label for="invoices_number">Invoice Number</label>
            <input type="text" name="invoices_number" id="invoices_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="school_finance_package_id">Paket Pembiayaan Sekolah :</label>
            <select name="school_finance_package_id" class="form-control" required>
                <option value="">Pilih Paket Pembiayaan</option>
                @foreach ($schoolFinancePackages as $schoolFinancePackage)
                    <option value="{{ $schoolFinancePackage->id }}" data-status-cashback="{{ $schoolFinancePackage->status_cashback }}">
                        {{ $schoolFinancePackage->school->name }} - {{ $schoolFinancePackage->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="month">Bulan :</label>
            <input type="date" name="month" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="students">Jumlah Siswa :</label>
            <div class="input-group">
                <input type="text" name="students" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text">Siswa</span>
                </div>
            </div>
        </div>

        <div class="form-group" id="input-cashback">
            <label for="cashback">Cashback</label>
            <div class="input-group">
                <div class="input-group">
                    <span class="input-group-text" id="cashback-nominal">Rp</span>
                    <input type="number" name="cashback" class="form-control" >
                    <span class="input-group-text" id="cashback-persentase">%</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="company_directors_id">Penanggung Jawab :</label>
            <select name="company_directors_id" class="form-control" required>
                <option value="">Pilih Penanggung Jawab</option>
                @foreach ($companyDirectors as $companyDirector)
                    <option value="{{ $companyDirector->id }}" data-name="{{ $companyDirector->name }}">
                        {{ $companyDirector->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Finance</button>
    </form>
</div>
<script>
    // Ambil elemen-elemen yang diperlukan
    const cashbackNominal = document.querySelector('#cashback-nominal');
    const cashbackPersentase = document.querySelector('#cashback-persentase');
    const cashbackInput = document.querySelector('#input-cashback');
    const schoolFinancePackageSelect = document.querySelector('[name="school_finance_package_id"]'); // Pilih elemen "select"

    // Function untuk menampilkan/hide elemen "Cashback" berdasarkan status_cashback
    function updateCashbackDisplay() {
        const selectedOption = schoolFinancePackageSelect.options[schoolFinancePackageSelect.selectedIndex];
        const status_cashback = selectedOption.getAttribute('data-status-cashback');

        if (status_cashback === "Nominal") {
            cashbackNominal.style.display = 'block';
            cashbackPersentase.style.display = 'none'; // Fixed typo
            cashbackInput.style.display = 'block';
        } else if (status_cashback === "Persentase") {
            cashbackNominal.style.display = 'none';
            cashbackPersentase.style.display = 'block';
            cashbackInput.style.display = 'block';
        } else {
            cashbackNominal.style.display = 'none';
            cashbackPersentase.style.display = 'none';
            cashbackInput.style.display = 'none';
        }
    }

    // Panggil function saat halaman dimuat untuk menetapkan tampilan awal
    updateCashbackDisplay();

    // Panggil function saat elemen "select" berubah
    schoolFinancePackageSelect.addEventListener('change', updateCashbackDisplay);

    // Validasi cashback saat mengirimkan formulir
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const selectedOption = schoolFinancePackageSelect.options[schoolFinancePackageSelect.selectedIndex];
        const status_cashback = selectedOption.getAttribute('data-status-cashback');

        if (status_cashback === "Nominal") {
            const cashbackInput = document.querySelector('input[name="cashback"]');
            if (cashbackInput.value === '') {
                event.preventDefault(); // Hentikan pengiriman formulir jika cashback masih kosong
                alert('Cashback harus diisi jika status cashback adalah "Nominal"');
            }
        }
    });
</script>
@endsection
