@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Finance</h2>
    <form method="POST" action="{{ route('finances.update', $finance->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="invoices_number">Invoice Number</label>
            <input type="text" name="invoices_number" id="invoices_number" value="{{ $finance->invoices_number }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="month">Bulan :</label>
            <input type="date" name="month" class="form-control" value="{{ $finance->month }}">
        </div>

        <div class="form-group">
            <label for="total_payment">Total Pembayaran :</label>
            <div class="input-group-append">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="total_payment" class="form-control" value="{{ $finance->total_payment }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="students">Jumlah Siswa :</label>
            <div class="input-group">
                <input type="text" name="students" class="form-control" value="{{ $finance->students }}">
                <div class="input-group-append">
                    <span class="input-group-text">Siswa</span>
                </div>
            </div>
        </div>

        <div class="form-group" id="input-cashback">
            <label for="cashback">Cashback</label>
            <div class="input-group-append">
                <span class="input-group-text" id="cashback-nominal">Rp</span>
                <input type="number" name="cashback" class="form-control" value="{{ $finance->cashback }}">
                <span class="input-group-text" id="cashback-persentase">%</span>
            </div>
        </div>

        <div class="form-group">
            <label for="company_directors_id">Paket Pembiayaan</label>
            <select name="company_directors_id" class="form-control">
                <option value=" {{ $finance->company_directors_id }}">{{ $finance->company_directors->name }}</option>
                @foreach ($companyDirectors as $companyDirector)
                    <option value="{{ $companyDirector->id }}" data-name="{{ $companyDirector->name }}">
                        {{ $companyDirector->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="Lunas" {{ old('status', $finance->status) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ old('status', $finance->status) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Finance</button>
    </form>
</div>

<script>
    // Dapatkan jenis paket pembiayaan dari schoolFinancePackage
    var statusCashbackType = "{{ $schoolFinancePackage->status_cashback }}";
    var priceMonth = parseFloat("{{ $schoolFinancePackage->monthly_cost }}");
    var packageType = "{{ $schoolFinancePackage->packages }}";
    var statusTaxType = "{{ $schoolFinancePackage->tax }}";

    // Temukan elemen-elemen yang akan diubah
    var cashbackNominalSpan = document.getElementById("cashback-nominal");
    var cashbackPersentaseSpan = document.getElementById("cashback-persentase");
    var inputCashback = document.querySelector('input[name="cashback"]');

    // Function to update total payment based on input values
    function updateTotalPayment() {
        const students = parseFloat(document.querySelector('input[name="students"]').value) || 0;
        let cashback = 0; // Inisialisasi nilai cashback dengan 0
        let totalPayment = 0;

        if (statusCashbackType === "Nominal") {
            cashback = parseFloat(inputCashback.value) || 0;
        } else if (statusCashbackType === "Persentase") {
            cashback = parseFloat(inputCashback.value) || 0;
        }

        if (statusTaxType === "Ditanggung") {
            ppn = 0;
        } else {
            ppn = priceMonth * 0.11;
        }

        if (packageType === "Siswa") {
            // Sembunyikan atau tampilkan elemen sesuai dengan jenis paket pembiayaan
            if (statusCashbackType === "Nominal") {
                totalPayment = (students * priceMonth) - cashback - ppn;
                cashbackPersentaseSpan.style.display = "none";
                cashbackNominalSpan.style.display = "block";
                inputCashback.style.display = "block";
            } else if (statusCashbackType === "Persentase") {
                totalPayment = (students * priceMonth) * (1 - cashback / 100) - ppn;
                cashbackNominalSpan.style.display = "none";
                cashbackPersentaseSpan.style.display = "block";
                inputCashback.style.display = "block";
            } else {
                totalPayment = students * priceMonth;
                cashbackNominalSpan.style.display = "none";
                cashbackPersentaseSpan.style.display = "none";
                inputCashback.style.display = "none";
            }
        } else {
            // Sembunyikan atau tampilkan elemen sesuai dengan jenis paket pembiayaan
            if (statusCashbackType === "Nominal") {
                totalPayment = priceMonth - cashback - ppn;
                cashbackPersentaseSpan.style.display = "none";
                cashbackNominalSpan.style.display = "block";
                inputCashback.style.display = "block";
            } else if (statusCashbackType === "Persentase") {
                totalPayment = priceMonth * (1 - cashback / 100) - ppn;
                cashbackNominalSpan.style.display = "none";
                cashbackPersentaseSpan.style.display = "block";
                inputCashback.style.display = "block";
            } else {
                totalPayment = priceMonth;
                cashbackNominalSpan.style.display = "none";
                cashbackPersentaseSpan.style.display = "none";
                inputCashback.style.display = "none";
            }
        }

        // Update the readonly input field
        document.querySelector('input[name="total_payment"]').value = totalPayment;
    }

    // Attach event listeners to input fields for real-time updates
    document.querySelector('input[name="students"]').addEventListener('input', updateTotalPayment);
    document.querySelector('input[name="cashback"]').addEventListener('input', updateTotalPayment);

    // Initialize total payment calculation
    updateTotalPayment();
</script>

@endsection
