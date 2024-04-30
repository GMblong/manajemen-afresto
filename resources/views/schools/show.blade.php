@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h3 class="m-0 font-weight-bold text-black">{{ $school->name }}</h3>
            <a href="{{ route('schools.edit', $school) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 20%;">Nama Kepala Sekolah</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 5%;">Kota</th> 
                    <th style="width: 10%;">Nomor Telepon</th>
                    <th>URL Sekolah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $school->headmaster_name }}</td>
                    <td>{{ $school->address }}</td>
                    <td>{{ $school->city }}</td>
                    <td>{{ $school->phone_number }}</td>
                    <td><a href="{{ $school->url }}">{{ $school->url }}</a></td>
                    <td class="text-center">
                        <a class="badge {{ $school->status === 'Berlangganan' ? 'badge-primary' : ($school->status === 'Selesai' ? 'badge-success' : ($school->status === 'Proses SPK' ? 'badge-warning' : ($school->status === 'Putus Kontrak' ? 'badge-danger' : 'badge-secondary'))) }}">{{ $school->status }}</a>
                    </td>
                </tr>
            <style>
                th {
                    text-align: center;
                    font-size: large;
                }
            </style>
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="card shadow mt-3">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0 font-weight-bold text-black">Detail Pembiayaan</h3>
    </div>
    <div class="card-body">
        @if ($school->schoolFinancePackages->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Paket Langganan</th>
                        <th>Paket Pembiayaan</th>
                        <th>Deskripsi Paket</th>
                        <th>Biaya Bulanan</th>
                        <th>Cashback</th>
                        <th>Pajak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->schoolFinancePackages as $schoolFinancePackage)
                        <tr>
                            <td class='text-center'>{{ $loop->iteration }}</td>
                            <td>{{ $schoolFinancePackage->name }}</td>
                            <td>{{ $schoolFinancePackage->packages }}</td>
                            <td>{{ $schoolFinancePackage->description }}</td>
                            <td>{{ formatCurrency($schoolFinancePackage->monthly_cost) }}</td>
                            <td>{{ $schoolFinancePackage->status_cashback }}</td>
                            <td>{{ $schoolFinancePackage->status_tax }}</td>
                            <td class="text-center">
                                <a href="{{ route('school-finance-packages.edit', ['school' => $school, 'school_finance_package' => $schoolFinancePackage->id]) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
                                
                                <form method="POST" action="{{ route('school-finance-packages.destroy', ['school_finance_package' => $schoolFinancePackage->id]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('school-finance-packages.create', ['id' => $school->id]) }}" class="btn btn-success">Tambah Paket Pembiayaan Baru</a>
        </div>
        @else
            <p>Belum ada langganan untuk sekolah ini.</p>
            <a href="{{ route('school-finance-packages.create', ['id' => $school->id]) }}" class="btn btn-success">Buat Paket Pembiayaan Baru</a>
        @endif
    </div>
</div>


<div class="card shadow mt-3">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0 font-weight-bold text-black">Detail Perjanjian</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        @if ($school->agreements->count() > 0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light   ">
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Tanggal Tenggat Waktu</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->agreements as $agreement)
                    <tr class="text-center">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="font-weight-bold">{{ $agreement->agreements_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($agreement->start_date)->isoFormat('D'). ' ' . getIndonesianMonth(\Carbon\Carbon::parse($agreement->start_date)->format('n')) . ' ' . \Carbon\Carbon::parse($agreement->start_date)->format('Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($agreement->end_date)->isoFormat('D'). ' ' . getIndonesianMonth(\Carbon\Carbon::parse($agreement->end_date)->format('n')) . ' ' . \Carbon\Carbon::parse($agreement->end_date)->format('Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($agreement->due_date)->isoFormat('D'). ' ' . getIndonesianMonth(\Carbon\Carbon::parse($agreement->due_date)->format('n')) . ' ' . \Carbon\Carbon::parse($agreement->due_date)->format('Y') }}</td>
                        <td class="text-center">
                            @if (strtotime($agreement->due_date) < strtotime('today'))
                                @if ($agreement->status === 'Sudah Perpanjangan')
                                    <span class="badge badge-success">Sudah Perpanjangan</span>
                                @else
                                    <span class="badge badge-danger">Perlu Perpanjangan</span>
                                @endif
                            @elseif (strtotime('today') >= strtotime($agreement->start_date) && strtotime('today') <= strtotime($agreement->due_date))
                                <span class="badge badge-primary"></span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($agreement->agreements_files)
                                @foreach ($agreement->agreements_files as $file)
                                <a href="{{ asset('storage/agreement_files/' . $file) }}" class="btn btn-warning btn-icon-split" target="_blank">
                                    <span class="icon text-white-80">
                                        <i class="fas fa-file"></i>
                                    </span>
                                    <span class="text">Bukti {{ $loop->iteration }}</span>
                                </a>
                                @endforeach
                            @else
                                Upload Bukti
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('agreements.edit', ['school' => $school, 'agreement' => $agreement]) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
                            <a href="{{ route('agreements.print', ['school' => $school, 'agreement' => $agreement->id]) }}" class="btn btn-success"><i class="fa fa-print"></i></a>
                            <form method="POST" action="{{ route('agreements.destroy', ['school' => $school, 'agreement' => $agreement]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                <a href="{{ route('agreements.create', ['school' => $school]) }}" class="btn btn-warning">Tambah Perjanjian Baru</a>
                <a href="{{ route('schools.index') }}" class="btn btn-primary">Kembali ke Daftar Sekolah</a>
            </div>
        </div>
        @else
            <p>Belum ada perjanjian untuk sekolah ini.</p>
            <a href="{{ route('agreements.create', ['school' => $school]) }}" class="btn btn-warning">Tambah Perjanjian</a>
            <a href="{{ route('schools.index') }}" class="btn btn-primary">Kembali ke Daftar Sekolah</a>
        @endif
    </div>
</div>
@endsection
