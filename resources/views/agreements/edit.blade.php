@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0  font-weight-bold text-black">Edit Perjanjian</h3>
    </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agreements.update', $agreement) }}" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $agreement->start_date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Tanggal Berakhir</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $agreement->end_date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Tanggal Tenggat Waktu</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $agreement->due_date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="agreements_number">Nomor Surat</label>
                        <input type="text" name="agreements_number" id="agreements_number" class="form-control" value="{{ $agreement->agreements_number }}" required>
                    </div>

                    <div class="form-group">
                        <label for="school_letter_number">Nomor Surat Sekolah</label>
                        <input type="text" name="school_letter_number" id="school_letter_number" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="agreement_files">File Perjanjian</label>
                        <input type="file" name="agreement_files[]" multiple class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" {{ $agreement->status === null ? 'selected' : '' }}>Pilih Status</option>
                            <option value="Sudah Perpanjangan" {{ $agreement->status === 'Sudah Perpanjangan' ? 'selected' : '' }}>Sudah Perpanjangan</option>
                            <option value="Perlu Perpanjangan" {{ $agreement->status === 'Perlu Perpanjangan' ? 'selected' : '' }}>Perlu Perpanjangan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company_directors_id">Penanggung Jawab</label>
                        <select name="company_directors_id" id="company_directors_id" class="form-control">
                            <option value="1" {{ $agreement->company_directors_id === 'Dhin Aristo Birawa Nuraga, S.Kom' ? 'selected' : '' }}>Dhin Aristo Birawa Nuraga, S.Kom</option>
                            <option value="2" {{ $agreement->company_directors_id === 'Adimas Sulistyadi, S.Pd' ? 'selected' : '' }}>Adimas Sulistyadi, S.Pd</option>
                            <option value="3" {{ $agreement->company_directors_id === 'Tatit Primadi, S.E' ? 'selected' : '' }}>Tatit Primadi, S.E</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
