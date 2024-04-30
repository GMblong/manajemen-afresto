@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3 mb-3">
        <h3 class="m-0  font-weight-bold text-black">Tambah Sekolah</h3>
    </div>
    <form method="POST" action="{{ route('schools.store') }}">
        @csrf
        <div class="ml-3 mr-3 mb-3">
            <div class="form-group">
                <label for="name">Nama Sekolah</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat Sekolah</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="city">Kota</label>
                <select name="city" id="city" class="form-control">
                    <option value="">Pilih Kota</option> 
                    <option value="Semarang">Semarang</option>
                    <option value="Kudus">Kudus</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Bali">Bali</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Pekanbaru">Pekanbaru</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone_number">Nomor Telepon Sekolah</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="headmaster_name">Nama Kepala Sekolah</label>
                <input type="text" name="headmaster_name" id="headmaster_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Proses SPK">Proses SPK</option>
                    <option value="Berlangganan">Berlangganan</option>                
                    <option value="Putus Kontrak">Putus Kontrak</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
@endsection
