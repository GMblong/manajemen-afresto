@extends('layouts.app')

@section('content')
    <h1>Daftar Paket Pembiayaan Sekolah</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Paket Pembiayaan</th>
                <th>Biaya Bulanan</th>
                <th>Deskripsi</th>
                <th>Nilai Cashback</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schoolFinancePackages as $package)
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ $package->name }}</td>
                    <td>{{ $package->package }}</td>
                    <td>{{ $package->monthly_cost }}</td>
                    <td>{{ $package->description }}</td>
                    <td>{{ $package->cashback }}</td>
                    <td>
                        <a href="{{ route('school-finance-packages.edit', $package) }}" class="btn btn-primary">Edit</a>
                        
                        <!-- Tambahkan tombol Hapus -->
                        <form method="POST" action="{{ route('school-finance-packages.destroy', $package) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('school-finance-packages.create', ['school_id' => $school->id]) }}">Tambah Paket Pembiayaan</a>

@endsection
