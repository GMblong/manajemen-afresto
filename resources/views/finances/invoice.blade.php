<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        @page {
            margin: 0;
        }
        .page-break {
            page-break-after: always;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            background-image: url('watermark-invoice.png');
            background-repeat: no-repeat;
            background-size: 110%;
            background-position: center;
        }

        .container{
            margin-left: 6%;
            margin-right: 6%;
            margin-top: 22%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        td {
            border: 1px solid #000;
            vertical-align: top;
        }

        p {
            margin: 0;
        }

        .header {
            text-align: left;
        }

        .invoice-details {
            width: 21%;
        }

        .invoice-details p {
            font-weight: bold;
        }

        .item-description {
            font-weight: bold;
            text-align: center;
        }

        .total {
            font-weight: bold;
        }

        .bank-details {
            background-color: #f2f2f2;
        }

        .bank-details p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table cellspacing="0" cellpadding="8">
            <tr class="header">
                <td rowspan="3" style="width: 52%;">
                    <strong style="text-transform: uppercase;">{{ $finance->schoolFinancePackage->school->name }}</strong><br>
                    <p>{{ $finance->schoolFinancePackage->school->address }}</p>
                </td>
                <td colspan="2" style="text-align: center; background-color: #f2f2f2; font-weight: bold; font-size: 20px">
                    <p>INVOICE</p>
                </td>
            </tr>
            <tr class="invoice-details">
                <td style="width: 24%;">
                    <p>INVOICE DATE</p>
                </td>
                <td>
                    <p>{{ \Carbon\Carbon::parse($finance->month)->format('d/m/Y') }}</p>
                </td>

            </tr>
            <tr class="invoice-details">
                <td>
                    <p>INVOICE NUMBER</p>
                </td>
                <td>
                    <p>{{ $finance->invoices_number}}</p>
                </td>
            </tr>
            <tr class="subject">
                <td colspan="3">
                    <p>Perihal : <br>
                        <strong>Penerapan {{ $finance->schoolFinancePackage->name }}</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="item-description" style="background-color: #f2f2f2;">
                    KETERANGAN
                </td>
                <td class="item-description" colspan="2" style="background-color: #f2f2f2;">
                    JUMLAH
                </td>
            </tr>

            @if ($finance->schoolFinancePackage->packages == 'Siswa')
            <tr>
                @if ($finance->schoolFinancePackage->status_tax == 'Ditanggung')
                <td>
                    Pembiayaan penerapan {{ $finance->schoolFinancePackage->name }} 
                    Sekolah bulan {{ \Carbon\Carbon::parse($finance->month)->translatedFormat('F Y') }} 
                    dengan Rincian {{ $finance->students }} siswa
                    <br><br>
                    Perhitungan Pajak <br>
                    PPN : <br>
                    PPH :
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->total_payment, 0, ',', '.') }},-
                    <br><br><br><br><br>
                    Rp. {{ number_format($finance->ppn, 0, ',', '.') }}
                    <br>
                    Rp. {{ number_format($finance->pph, 0, ',', '.') }}
                </td>
                @else
                <td>
                    Pembiayaan penerapan {{ $finance->schoolFinancePackage->name }}
                    Sekolah bulan {{ \Carbon\Carbon::parse($finance->month)->translatedFormat('F Y') }}
                    dengan Rincian {{ $finance->students }} siswa x Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost, 0, ',', '.') }}
                    <br>
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost * $finance->students, 0, ',', '.') }},-
                </td>
                @endif
            </tr>
            <tr class="total">
                <td style="background-color: #f2f2f2; text-align: right;">
                    TOTAL :
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost * $finance->students, 0, ',', '.') }},-
                </td>
            </tr>
            @else
            <tr>
                @if ($finance->schoolFinancePackage->status_tax == 'Ditanggung')
                <td>
                    Pembiayaan penerapan {{ $finance->schoolFinancePackage->name }} 
                    Sekolah bulan {{ \Carbon\Carbon::parse($finance->month)->translatedFormat('F Y') }} 
                    <br>
                    <br>
                    Perhitungan Pajak <br>
                    PPN
                    <br>
                    PPH
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->total_payment, 0, ',', '.') }},-
                    <br>
                    <br>
                    <br>
                    <br>
                    Rp. {{ number_format($finance->ppn, 0, ',', '.') }},- <br>
                    Rp. {{ number_format($finance->pph, 0, ',', '.') }},-
                </td>
                @else
                <td>
                    Pembiayaan penerapan {{ $finance->schoolFinancePackage->name }}
                    Sekolah bulan {{ \Carbon\Carbon::parse($finance->month)->translatedFormat('F Y') }}
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost, 0, ',', '.') }},-
                </td>
                @endif
            </tr>
            <tr class="total">
                <td style="background-color: #f2f2f2; text-align: right;">
                    TOTAL :
                </td>
                <td colspan="2">
                    Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost, 0, ',', '.') }},-
                </td>
            </tr>
            @endif
            <tr class="sender-info">
                <td rowspan="2">
                    <p>PT. Afresto Sistem Indonesia</p>
                    <br><br><br><br><br><br><br><br><br>
                    <strong>Adimas Sulistyadi, S.Pd.</strong>
                </td>
                @if ($finance->schoolFinancePackage->packages == 'Siswa') {
                <td colspan="2" style="font-style: italic;">
                    Terbilang : <br><br>
                    <strong># {{ ucwords(terbilang($finance->schoolFinancePackage->monthly_cost * $finance->students)) }} Rupiah #</strong>
                </td>   
                } @else {
                <td colspan="2" style="font-style: italic;">
                    Terbilang : <br><br>
                    <strong># {{ ucwords(terbilang($finance->schoolFinancePackage->monthly_cost)) }} Rupiah #</strong>
                </td>
                } @endif
            </tr>
            <tr class="bank-details">
                <td colspan="2">
                    <p style="font-style: italic;">Harap Dibayarkan Kepada :</p><br>
                    <p style="font-weight: bold;">PT. Afresto Sistem Indonesia</p>
                    <p style="font-weight: bold;">Bank Mandiri Taspen</p>
                    <p style="font-weight: bold;">Denpasar Branch</p>
                    <p style="font-weight: bold;">A/C Rupiah No. 0154117778899</p>
                </td>
            </tr>
        </table>
    </div>
        <div class="page-break"></div>
    <div class="container">
    <table cellspacing="0" cellpadding="8">
            <tr class="header">
                <td colspan="2" style="text-align: center; background-color: #f2f2f2; font-weight: bold; font-size: 20px">
                    <p>KUITANSI</p>
                </td>
            </tr>
            <tr class="invoice-details">
                <td>
                    Invoice
                </td>
                <td>
                    067/INV/ASI/X/2023
                </td>
            </tr>
            <tr class="invoice-details">
                <td style="width: 30%;">
                    Sudah Terima Dari
                </td>
                <td>
                <strong style="text-transform: uppercase;">{{ $finance->schoolFinancePackage->school->name }}</strong>
                </td>
            </tr>
            <tr class="invoice-details">
                <td style="width: 21%;">
                    Terbilang
                </td>
                @if ($finance->schoolFinancePackage->packages == 'Siswa') {
                <td>
                    {{ ucwords(terbilang($finance->schoolFinancePackage->monthly_cost * $finance->students)) }} Rupiah
                </td>
                } @else {
                <td>
                    {{ ucwords(terbilang($finance->schoolFinancePackage->monthly_cost)) }} Rupiah
                </td>
                } @endif

            </tr>
            <tr class="invoice-details">
                <td style="width: 21%;">
                    Untuk Pembayaran
                </td>
                <td>
                    Pembiayaan Penerapan {{ $finance->schoolFinancePackage->name }} Sekolah bulan {{ \Carbon\Carbon::parse($finance->month)->translatedFormat('F Y') }} 
                    <br><br><br><br><br><br><br><br>
                </td>
            </tr>
            <tr class="invoice-details">
                <td style="background-color: #f2f2f2; width: 21%;">
                    <p>Jumlah</p>
                </td>
                @if ($finance->schoolFinancePackage->packages == 'Siswa') {
                <td>
                    <strong>Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost * $finance->students, 0, ',', '.') }},-</strong>
                </td>
                } @else {
                <td>
                    <strong>Rp. {{ number_format($finance->schoolFinancePackage->monthly_cost, 0, ',', '.') }},-</strong>
                </td>
                } @endif
            </tr>
        </table>
        <div style="text-align: left; margin-left: 65%; margin-top: 20%">
            <p>{{ \Carbon\Carbon::parse($finance->month)->translatedFormat('d F Y') }}</p>
            <p>PT Afresto Sistem Indonesia</p>
            <br><br><br><br><br><br><br>
            <b>Adimas Sulistyadi, S.Pd</b>
        </div>
    </div>

</body>

</html>
