@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <canvas id="totalPaymentsChart" width="100%" height="17%" class="ml-3 mb-3 mr-3 mt-3"></canvas>
</div>

<div class="card shadow ">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h3 class="m-0 font-weight-bold text-black">Pembayaran Sekolah</h3>
        <a href="{{ route('finances.create') }}" class="btn btn-success"><i class="fa fa-plus mr-3"></i>Buat Pembayaran</a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('finances.index') }}">
            <div class="form-group">
                <input type="text" class="form-control" id="filterInput" placeholder="Pencarian">
            </div>
            <div class="form-row d-flex justify-content-between align-items-center">
                <div class="form-group col-md-3">
                    <select name="filter_month" id="filter_month" class="form-control">
                        <option value="">Pilih Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select name="filter_year" id="filter_year" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($year = $currentYear; $year <= 2045; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select name="filter_packages" id="filter_packages" class="form-control">
                        <option value="">Pilih Paket</option>
                        @foreach($packages as $package)
                            <option value="{{ $package }}">{{ $package }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select name="filter_city" id="filter_city" class="form-control">
                        <option value="">Pilih Kota</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select name="perPage" id="perPage" class="form-control">
                        <option value="10" {{ Request::input('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ Request::input('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ Request::input('perPage') == 100 ? 'selected' : '' }}>100</option>
                        <option value="200" {{ Request::input('perPage') == 200 ? 'selected' : '' }}>200</option>
                        <option value="500" {{ Request::input('perPage') == 500 ? 'selected' : '' }}>500</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search mr-2"></i> Pencarian
            </button>
        </form>
    </div>

    <div class="card-body">
        @if ($finances->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Bulan</th>
                        <th>Paket Pembiayaan</th>
                        <th>Siswa</th>
                        <th>Biaya Bulanan</th>
                        <th>Cashback</th>
                        <th>PPn</th>
                        <th>PPh</th>
                        <th>Total Pajak</th>
                        <th>Total Pembayaran</th>
                        <th>Income</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($finances as $finance)
                        <tr>
                            <td class='text-center'>{{ $loop->iteration }}</td>
                            <td>{{ $finance->schoolFinancePackage->school->name }}</td>
                            <td>{{ formatMonthYear($finance->month) }}</td>
                            <td>{{ $finance->schoolFinancePackage->packages }}</td>
                            <td>{{ $finance->students }}</td>
                            <td>{{ $finance->monthly_cost_formatted }}</td>
                            <td>{{ $finance->cashback_formatted }}</td>
                            <td>{{ $finance->ppn_formatted }}</td>
                            <td>{{ $finance->pph_formatted }}</td>
                            <td>{{ $finance->tax_formatted }}</td>
                            <td><strong>{{ $finance->total_payment_formatted }}</strong></td>
                            <td><strong>{{ $finance->income_formatted }}</strong></td>
                            <td class="text-center">
                                <a href="{{ route('finances.edit', $finance->id) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
                                <a href="{{ route('finances.printInvoice', $finance->id) }}" class="btn btn-success"><i class="fa fa-print"></i></a>
                                <form method="POST" action="{{ route('finances.destroy', $finance->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="11" class="text-right" style="background-color: #778899; color: white;"><strong>Total :</strong></td>
                        <td colspan="2" style="background-color: orange; color: white;">
                            <strong>{{ formatCurrency($finances->sum('income')) }}</strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @else
            <p>Belum ada langganan untuk sekolah ini.</p>
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('totalPaymentsChart').getContext('2d');
    var months = {!! json_encode($uniqueMonths ) !!};
    var totalPayments = {!! json_encode($totalPayments) !!};


    // Palet warna yang berisi 12 warna berbeda
    const colorPalette = [
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(220, 220, 220, 0.6)',
        'rgba(110, 180, 180, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
    ];

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Pembayaran',
                data: totalPayments,
                borderColor: colorPalette,
                backgroundColor: colorPalette, // Menggunakan palet warna
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                duration: 1000, // Durasi animasi dalam milidetik
                easing: 'easeInOutQuart',
                loop: false,
            },
            scales: {
                y: {
                    beginAtZero: true, // Mulai dari nol (0)
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Pembayaran per Bulan',
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ' : ';
                            }
                            label += 'Rp. ' + totalPayments[context.dataIndex] ;
                            return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                }
            }
        }
    });
    $(document).ready(function() {
        $("#filterInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

@endsection