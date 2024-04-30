<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use App\Models\School;
use App\Models\SchoolFinancePackage;
use App\Models\CompanyDirectors;
use Hafid\Terbilang\Terbilang;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $cities = School::distinct()->pluck('city');
        $packages = SchoolFinancePackage::distinct()->pluck('packages');
        $finances = Finance::with('schoolFinancePackage.school');
        $companyDirectors = CompanyDirectors::all();
    
        $filterMonth = $request->input('filter_month');
        $filterYear = $request->input('filter_year');
        $filterCity = $request->input('filter_city');
        $filterPackages = $request->input('filter_packages');
        $perPage = $request->input('perPage', 10); // Jumlah data per halaman, default 10
    
        if ($filterMonth) {
            $finances->whereMonth('month', $filterMonth);
        }
        if ( $filterYear) {
            $finances->whereYear('month', $filterYear);
        }
    
        if ($filterCity) {
            $finances->whereHas('schoolFinancePackage.school', function ($query) use ($filterCity) {
                $query->where('city', $filterCity);
            });
        }
    
        if ($filterPackages) {
            $finances->whereHas('schoolFinancePackage', function ($query) use ($filterPackages) {
                $query->where('packages', $filterPackages);
            });
        }
    
        $finances = $finances->orderBy('month', 'desc')->paginate($perPage); // Menggunakan $perPage
    
        // Format currency in the collection
        $finances->transform(function ($finance) {
            $finance->monthly_cost_formatted = formatCurrency($finance->schoolFinancePackage->monthly_cost);
            $finance->cashback_formatted = formatCurrency($finance->cashback);
            $finance->ppn_formatted = formatCurrency($finance->ppn);
            $finance->pph_formatted = formatCurrency($finance->pph);
            $finance->tax_formatted = formatCurrency($finance->tax);
            $finance->total_payment_formatted = formatCurrency($finance->total_payment);
            $finance->income_formatted = formatCurrency($finance->income);
            return $finance;
        });
    
        // Menghitung total pembayaran
        $totalPaymentsData = $finances->sum('income');
    
        // Menghitung total pembayaran per bulan
        $totalPayments = $finances->groupBy(function ($finance) {
            return Carbon::createFromFormat('Y-m-d', $finance->month)->format('M Y');
        })->map(function ($monthFinances) {
            return $monthFinances->sum('income');
        })->values()->toArray();
        // Menginisialisasi array untuk menyimpan bulan yang sudah ada
        $uniqueMonths = [];
    
        // Memformat bulan
        $months = $finances->reduce(function ($carry, $finance) use (&$uniqueMonths) {
            $date = \DateTime::createFromFormat('Y-m-d', $finance->month);
            $formattedMonth = $date->format('M Y'); // Format bulan seperti "Jan 2023"
    
            if (!in_array($formattedMonth, $uniqueMonths) && count($carry) < 12) {
                $uniqueMonths[] = $formattedMonth;
                $carry[] = $formattedMonth;
            }
    
            return $carry;
        }, []);
    
        // Pass the transformed collection to the view
        return view('finances.index', compact('finances', 'totalPaymentsData', 'totalPayments', 'cities', 'uniqueMonths', 'months', 'packages'));
    }
    

    public function create(SchoolFinancePackage $schoolFinancePackage)
    {
        $schoolFinancePackages = SchoolFinancePackage::all();
        $companyDirectors = CompanyDirectors::all();
        return view('finances.create', compact('schoolFinancePackages', 'companyDirectors'));
    }

    public function store(Request $request)
    {
        // Validasi inputan dari formulir
        $request->validate([
            'invoices_number' => 'required',
            'school_finance_package_id' => 'required',
            'month' => 'required|date_format:Y-m-d',
            'students' => 'required|numeric',
            'cashback' => 'nullable|numeric',
            'ppn' => 'nullable|numeric',
            'pph' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'total_payment' => 'nullable|numeric',
            'income' => 'nullable|numeric', // Menambahkan validasi untuk "income"
            'company_directors_id' => 'required',
            'status' => 'in:Lunas,Belum Lunas',
        ]);

        $invoicesNumber = $request->input('invoices_number');
        // Ambil data paket pembiayaan terkait
        $schoolFinancePackage = SchoolFinancePackage::find($request->input('school_finance_package_id'));
        if (!$schoolFinancePackage) {
            return redirect()->route('finances.create')
                ->with('error', 'Paket pembiayaan tidak ditemukan.');
        }

        $price = $schoolFinancePackage->monthly_cost;
        $month = $request->input('month');
        $students = $request->input('students');

        if ($schoolFinancePackage->packages === 'Siswa') {
            if ($schoolFinancePackage->status_cashback === 'Nominal') {
                    $cashback = $request->input('cashback');
                } elseif ($schoolFinancePackage->status_cashback === 'Persentase') {
                    $cashback = (($price * $students) * $request->input('cashback')) / 100;  
                } else {
                    $cashback = 0;
                }

            $ppn = ($price * $students) - (($price * $students) / 1.11);
            $pph = $ppn / 5.55;
            $tax = $ppn + $pph;

            if ($schoolFinancePackage->status_tax === 'Ditanggung') {
                    $totalPayment = ($price * $students);
                    $income = ($price * $students) - $cashback - $tax;
                } else {
                    $totalPayment = ($price * $students) - $ppn;
                    $income = ($price * $students) - $cashback - $pph;
                };

        } else {
            if ($schoolFinancePackage->status_cashback === 'Nominal') {
                $cashback = $request->input('cashback');
            } elseif ($schoolFinancePackage->status_cashback === 'Persentase') {
                $cashback = ($price * $request->input('cashback')) / 100;  
            } else {
                $cashback = 0;
            }

            $ppn = $price - ($price / 1.11);
            $pph = $ppn / 5.55;
            $tax = $ppn + $pph;

            if ($schoolFinancePackage->status_tax === 'Ditanggung') {
                $totalPayment = $price - $ppn;
                $income = $price - $cashback - $tax;
            } else {
                $totalPayment = $price;
                $income = $price - $cashback - $pph;
            }
        }

        $companyDirectors = CompanyDirectors::find($request->input('company_directors_id'));
        if (!$companyDirectors) {
            return redirect()->route('finances.create')
                ->with('error', 'Paket pembiayaan tidak ditemukan.');
        }
        $status = $request->input('status');

        // Simpan data pembiayaan baru
        $finance = new Finance([
            'invoices_number' => $invoicesNumber,
            'school_finance_package_id' => $schoolFinancePackage->id,
            'month' => $month,
            'students' => $students,
            'cashback' => $cashback,
            'ppn' => $ppn,
            'pph' => $pph,
            'tax' => $tax,
            'total_payment' => $totalPayment,
            'income' => $income,
            'company_directors_id' => $companyDirectors->id,
            'status' => $status,
        ]);
        
        try {
            $finance->save();
        } catch (\Exception $e) {
            return redirect()->route('finances.create')
                ->with('error', 'Gagal menyimpan data pembiayaan: ' . $e->getMessage());
        }

        // Redirect ke halaman yang sesuai
        return redirect()->route('finances.index')
            ->with('success', 'Pembiayaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Temukan data pembiayaan yang akan diedit berdasarkan ID
        $finance = Finance::find($id);
        $schoolFinancePackage = SchoolFinancePackage::find($finance->school_finance_package_id);
        $companyDirectors = CompanyDirectors::all();
    
        if (!$finance) {
            return redirect()->route('finances.index')
                ->with('error', 'Pembiayaan tidak ditemukan.');
        }
    
        return view('finances.edit', compact('finance', 'schoolFinancePackage', 'companyDirectors'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi inputan dari formulir
        $request->validate([
            'invoices_number' => 'required',
            'school_finance_package_id' => 'required',
            'month' => 'required|date_format:Y-m-d',
            'students' => 'required|numeric',
            'cashback' => 'nullable|numeric',
            'ppn' => 'nullable|numeric',
            'pph' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'total_payment' => 'nullable|numeric',
            'income' => 'nullable|numeric', // Menambahkan validasi untuk "income"
            'company_directors_id' => 'required',
            'status' => 'in:Lunas,Belum Lunas',
        ]);
    
        // Ambil data pembiayaan yang akan diperbarui
        $finance = Finance::find($id);
        if (!$finance) {
            return redirect()->route('finances.index')
                ->with('error', 'Pembiayaan tidak ditemukan.');
        }
    
        // Ambil data paket pembiayaan terkait
        $schoolFinancePackage = SchoolFinancePackage::find($finance->school_finance_package_id);
        if (!$schoolFinancePackage) {
            return redirect()->route('finances.edit', $id)
                ->with('error', 'Paket pembiayaan tidak ditemukan.');
        }
    
        $price = $schoolFinancePackage->monthly_cost;
        $students = $request->input('students');
    
        if ($schoolFinancePackage->packages === 'Siswa') {
            if ($schoolFinancePackage->status_cashback === 'Nominal') {
                $cashback = $request->input('cashback');
            } elseif ($schoolFinancePackage->status_cashback === 'Persentase') {
                $cashback = ($price * $students * $request->input('cashback')) / 100;
            } else {
                $cashback = 0;
            }
    
            $ppn = ($price * $students) - (($price * $students) / 1.11);
            $pph = $ppn / 5.55;
            $tax = $ppn + $pph;
    
            if ($schoolFinancePackage->status_tax === 'Ditanggung') {
                $totalPayment = ($price * $students) - $ppn;
                $income = ($price * $students) - $cashback - $tax;
    
            } else {
                $totalPayment = ($price * $students);
                $income = ($price * $students) - $cashback - $pph;
    
            }
    
            
        } else {
            if ($schoolFinancePackage->status_cashback === 'Nominal') {
                $cashback = $request->input('cashback');
            } elseif ($schoolFinancePackage->status_cashback === 'Persentase') {
                $cashback = ($price * $request->input('cashback')) / 100;
            } else {
                $cashback = 0;
            }
    
            $ppn = $price - ($price / 1.11);
            $pph = $ppn / 5.55;
            $tax = $ppn + $pph;
    
            if ($schoolFinancePackage->status_tax === 'Ditanggung') {
                $totalPayment = $price - $ppn;
                $income = $price - $cashback - $tax;
            } else {
                $totalPayment = $price;
                $income = $price - $cashback - $pph;
            }

        }

        $companyDirectors = CompanyDirectors::find($request->input('company_directors_id'));
        if (!$companyDirectors) {
            return redirect()->route('finances.create')
                ->with('error', 'Paket pembiayaan tidak ditemukan.');
        }

        if (!$companyDirectors) {
            // Data tidak ditemukan, Anda dapat menangani kasus ini dengan mengembalikan pesan atau melakukan tindakan lain yang sesuai.
            return redirect()->back()->with('error', 'Data Paket Pembiayaan tidak ditemukan.');
        }
        
    
        // Update data pembiayaan
        $finance->invoices_number = $request->input('invoices_number');
        $finance->school_finance_package_id = $schoolFinancePackage->id;
        $finance->month = $request->input('month');
        $finance->students = $students;
        $finance->tax = $tax;
        $finance->cashback = $cashback;
        $finance->ppn = $ppn;
        $finance->pph = $pph;
        $finance->income = $income;
        $finance->total_payment = $totalPayment;
        $finance->company_directors_id = $companyDirectors->id;
        $finance->status = $request->input('status');
    
        // Simpan perubahan pada model
        try {
            $finance->save();
        } catch (\Exception $e) {
            return redirect()->route('finances.create')
                ->with('error', 'Gagal menyimpan data pembiayaan: ' . $e->getMessage());
        }
    
        // Redirect ke halaman yang sesuai
        return redirect()->route('finances.index')
            ->with('success', 'Pembiayaan berhasil diperbarui.');
    }
    
    

    public function destroy($id)
    {
        // Temukan data pembiayaan yang akan dihapus berdasarkan ID
        $finance = Finance::find($id);

        if (!$finance) {
            return redirect()->route('finances.index')
                ->with('error', 'Pembiayaan tidak ditemukan.');
        }

        // Hapus data pembiayaan
        $finance->delete();

        // Redirect ke halaman yang sesuai
        return redirect()->route('finances.index')
            ->with('success', 'Pembiayaan berhasil dihapus.');
    }

    public function printInvoice(Finance $finance, $id)
    {
        // Temukan data pembiayaan berdasarkan ID
        $finance = Finance::find($id);

        if (!$finance) {
            return redirect()->route('finances.index')
                ->with('error', 'Pembiayaan tidak ditemukan.');
        }

        // Load view invoice dan data pembiayaan
        $pdf = PDF::loadView('finances.invoice', compact('finance'));

        // Tampilkan atau unduh file PDF
        return $pdf->stream('invoice.pdf');
    }
}
