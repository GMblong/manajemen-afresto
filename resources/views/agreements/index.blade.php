@extends('layouts.app')

@section('content')
    <h1>Daftar Perjanjian</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Tanggal Tenggat Waktu</th>
                <th>Nomor Surat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agreements as $agreement)
                <tr>
                    <td>{{ $agreement->id }}</td>
                    <td>{{ $agreement->start_date }}</td>
                    <td>{{ $agreement->end_date }}</td>
                    <td>{{ $agreement->due_date }}</td>
                    <td>{{ $agreement->agreements_number }}</td>
                    <td>
                        <a href="{{ route('agreements.show', $agreement) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('agreements.edit', $agreement) }}" class="btn btn-primary">Edit</a>
                        <!-- Anda dapat menambahkan tombol untuk menghapus jika diperlukan -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('agreements.create') }}" class="btn btn-success">Buat Perjanjian Baru</a>
@endsection
