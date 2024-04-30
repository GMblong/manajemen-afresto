@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0 font-weight-bold text-black">Tambah Paket Pembiayaan Sekolah Baru</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('school-finance-packages.store') }}">
            @csrf
            <div class="form-group">
                <label for="school_id">Sekolah</label>
                <select name="school_id" id="school_id" class="form-control" required>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}" {{ $school->id == $selectedSchoolId ? 'selected' : '' }}>
                            {{ $school->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nama Paket Langganan</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="packages">Paket Pembiayaan</label>
                <select name="packages" id="package" class="form-control" required>
                    <option value="Bulanan">Bulanan</option>
                    <option value="Siswa">Jumlah Siswa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Paket</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="monthly_cost">Biaya Bulanan</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" name="monthly_cost" id="monthly_cost" class="form-control" required>
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
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
