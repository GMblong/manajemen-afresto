@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0  font-weight-bold text-black">Edit Data Sekolah</h3>
    </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('schools.update', $school) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Nama Sekolah') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $school->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="address">{{ __('Alamat Sekolah') }}</label>
                            <textarea name="address" id="address" class="form-control" required>{{ $school->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">{{ __('Kota') }}</label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Pilih Kota</option>
                                <option value="Semarang" {{ $school->city === 'Semarang' ? 'selected' : '' }}>Semarang</option>
                                <option value="Kudus" {{ $school->city === 'Kudus' ? 'selected' : '' }}>Kudus</option>
                                <option value="Yogyakarta" {{ $school->city === 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                                <option value="Jakarta" {{ $school->city === 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                                <option value="Surabaya" {{ $school->city === 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                                <option value="Bali" {{ $school->city === 'Bali' ? 'selected' : '' }}>Bali</option>
                                <option value="Bandung" {{ $school->city === 'Bandung' ? 'selected' : '' }}>Bandung</option>
                                <option value="Bekasi" {{ $school->city === 'Bekasi' ? 'selected' : '' }}>Bekasi</option>
                                <option value="Pekanbaru" {{ $school->city === 'Pekanbaru' ? 'selected' : '' }}>Pekanbaru</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone_number">{{ __('Nomor Telepon Sekolah') }}</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $school->phone_number }}" required>
                        </div>

                        <div class="form-group">
                            <label for="headmaster_name">{{ __('Nama Kepala Sekolah') }}</label>
                            <input type="text" name="headmaster_name" id="headmaster_name" class="form-control" value="{{ $school->headmaster_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="url">{{ __('URL Sekolah') }}</label>
                            <input type="text" name="url" id="url" class="form-control" value="{{ $school->url ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Berlangganan" {{ $school->status === 'Berlangganan' ? 'selected' : '' }}>{{ __('Berlangganan') }}</option>
                                <option value="Proses SPK" {{ $school->status === 'Proses SPK' ? 'selected' : '' }}>{{ __('Proses SPK') }}</option>
                                <option value="Putus Kontrak" {{ $school->status === 'Putus Kontrak' ? 'selected' : '' }}>{{ __('Putus Kontrak') }}</option>
                                <option value="Selesai" {{ $school->status === 'Selesai' ? 'selected' : '' }}>{{ __('Selesai') }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">{{ __('Simpan Perubahan') }}</button>
                            <a href="{{ route('schools.index') }}" class="btn btn-primary">Kembali ke Daftar Sekolah</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
