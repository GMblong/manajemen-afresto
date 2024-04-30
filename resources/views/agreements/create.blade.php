@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0  font-weight-bold text-black">Tambah Perjanjian SPK Baru</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('agreements.store') }}">
            @csrf
            <div class="form-group">
                <label for="school_id">Sekolah</label>
                <select name="school_id" id="school_id" class="form-control" required>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">Tanggal Berakhir</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="due_date">Tanggal Tenggat Waktu</label>
                <input type="date" name="due_date" id="due_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="agreements_number">Nomor Surat</label>
                <input type="text" name="agreements_number" id="agreements_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="school_letter_number">Nomor Surat Sekolah</label>
                <input type="text" name="school_letter_number" id="school_letter_number" class="form-control">
            </div>

            <div class="form-group">
                <label for="company_directors_id">Penanggung Jawab</label>
                <select name="company_directors_id" id="company_directors_id" class="form-control">
                    <option value="1">Dhin Aristo Birawa Nuraga, S.Kom</option>
                    <option value="2">Adimas Sulistyadi, S.Pd</option>
                    <option value="3">Tatit Primadi, S.E</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
