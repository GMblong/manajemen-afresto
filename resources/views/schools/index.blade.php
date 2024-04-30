@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Berlangganan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berlanggananCount }} Sekolah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Proses SPK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prosesSPKCount }} Sekolah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Putus Kontrak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $putusKontrakCount }} Sekolah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persentase Card Example -->
        <!-- Persentase Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Persentase</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($persentase, 0) }}%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $persentase }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <div class="card shadow">
    <a href="{{ route('start-live-stream') }}" class="btn btn-primary">Start Live Stream</a>

        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h3 class="m-0 font-weight-bold text-black">Daftar Sekolah</h3>
            <a href="{{ route('schools.create') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-80">
                    <i class="fa fa-plus mt-1"></i>
                </span>
                <span class="text">Sekolah Baru</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <div class="form-group">
                <input type="text" class="form-control" id="filterInput" placeholder="Pencarian">
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="background: gold; color: white;">
                    <tr>
                        <th style="width: 3%;">No</th>
                        <th style="width: 15%;">Nama Sekolah</th>
                        <th style="width: 30%;">Alamat</th>
                        <th class="text-center" style="width: 5%;">Kota</th>
                        <!-- <th>Kepala Sekolah</th>
                        <th>Nomor Telepon</th> -->
                        <th style="width: 30%;">URL Sekolah</th>
                        <th style="width: 5%;">Status</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schools as $school)
                        <tr>
                            <td class='text-center'>{{ $loop->iteration }}</td>
                            <td>{{ $school->name }}</td>
                            <td>{{ $school->address }}</td>
                            <td>{{ $school->city }}</td>
                            <!-- <td>{{ $school->headmaster_name }}</td>
                            <td>{{ $school->phone_number }}</td> -->
                            <td><a href="{{ $school->url }}">{{ $school->url }}</a></td>
                            <td class='text-center'>
                                <span class="badge {{ $school->status === 'Berlangganan' ? 'badge-primary' : ($school->status === 'Selesai' ? 'badge-success' : ($school->status === 'Proses SPK' ? 'badge-warning' : ($school->status === 'Putus Kontrak' ? 'badge-danger' : 'badge-secondary'))) }}">{{ $school->status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('schools.show', $school) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('schools.edit', $school) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
                                <form method="POST" action="{{ route('schools.destroy', $school) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#filterInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>