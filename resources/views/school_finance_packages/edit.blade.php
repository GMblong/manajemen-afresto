@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0 font-weight-bold text-black">Edit Paket Pembiayaan Sekolah</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('school-finance-packages.update', ['school_finance_package' => $schoolFinancePackage]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="school_id">Sekolah</label>
                <input type="text" id="school_id" value="{{ $schoolFinancePackage->school->name }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="name">Nama Paket Langganan</label>
                <input type="text" name="name" id="name" value="{{ $schoolFinancePackage->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="packages">Paket Pembiayaan</label>
                <select name="packages" id="packages" class="form-control" required>
                    <option value="Bulanan" {{ $schoolFinancePackage->packages == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="Siswa" {{ $schoolFinancePackage->packages == 'Siswa' ? 'selected' : '' }}>Jumlah Siswa</option>
                    <option value="Bundling Internet" {{ $schoolFinancePackage->packages == 'Bundling Internet' ? 'selected' : '' }}>Bundling Internet</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Paket</label>
                <textarea name="description" id="description" class="form-control">{{ $schoolFinancePackage->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="monthly_cost">Biaya Bulanan</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" name="monthly_cost" id="monthly_cost" value="{{ $schoolFinancePackage->monthly_cost }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="status_cashback">Status Cashback</label>
                <select name="status_cashback" id="status_cashback" class="form-control">
                    <option value="Nominal">Nominal</option>
                    <option value="Persentase">Persentase</option>
                    <option value="Tidak Ada Cashback">Tidak Ada Cashback</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_tax">Status Pajak</label>
                <select name="status_tax" id="status_tax" class="form-control">
                    <option value="Ditanggung">Ditanggung</option>
                    <option value="Tidak Ditanggung">Tidak Ditanggung</option>
                </select>
            </div>

            <!-- Input field yang berisi ID sekolah -->
            <input type="hidden" name="school_id" value="{{ $schoolFinancePackage->school->id }}">

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
