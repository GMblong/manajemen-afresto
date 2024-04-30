<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Agreement;
use App\Models\CompanyDirectors;
use App\Models\School;
use Barryvdh\DomPDF\Facade\Pdf;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::all();
        $directors = CompanyDirectors::all();
        return view('agreements.index', compact('agreements'));
    }

    public function create()
    {
        $schools = School::all();
        return view('agreements.create', compact('schools'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'due_date' => 'required|date',
            'notified_at' => 'nullable|date',
            'agreements_number' => 'required|string',
            'school_letter_number' => 'nullable|string',
            'agreements_file' => 'nullable|mimes:pdf,doc,docx',
            'school_id' => 'required',
            'status' => 'in:Sudah Perpanjangan,Perlu Perpanjangan',
            'company_directors_id' => 'required',
        ]);

        // Check if the 'status' key exists in the validated data
        if (array_key_exists('status', $validatedData)) {
            $previousAgreement = Agreement::where('status', $validatedData['status'])
                ->where('agreements_number', $validatedData['agreements_number'])
                ->orderBy('created_at', 'desc')
                ->first();

            if ($previousAgreement) {
                $previousAgreement->status = 'Sudah Perpanjangan';
                $previousAgreement->save();
            }
        }

        // Validasi dan penyimpanan berkas
        if ($request->hasFile('agreements_file')) {
            $file = $request->file('agreements_file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('agreements', $fileName, 'public');
            $validatedData['agreements_file'] = $fileName;
        }

        // Selanjutnya, simpan data perjanjian ke database
        Agreement::create($validatedData);

        return redirect()->route('schools.show', ['school' => $validatedData['school_id']]);
    }

    public function edit(School $school, Agreement $agreement)
    {
        return view('agreements.edit', compact('school', 'agreement'));
    }
    
    public function update(Request $request, School $school, Agreement $agreement)
{
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'due_date' => 'required|date',
        'notified_at' => 'nullable|date',
        'agreements_number' => 'required|string',
        'agreements_file' => 'nullable|mimes:pdf,doc,docx',
        'school_letter_number' => 'nullable|string',
        'status' => 'nullable|in:Sudah Perpanjangan,Perlu Perpanjangan,null',
        'company_directors_id' => 'required',
    ]);

    $agreementFiles = [];
    if ($request->hasFile('agreement_files')) {
        foreach ($request->file('agreement_files') as $file) {
            if ($file->isValid()) {
                $path = $file->store('agreement_files', 'public');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('agreement_files', $filename, 'public');
                $agreementFiles[] = $filename;
            }
        }
    }

    // Pengecekan apakah due date telah lewat hari ini
    if (strtotime($agreement->due_date) >= strtotime('today')) {
        // Jika due date belum lewat, kita hanya memperbarui bagian lain kecuali status
        unset($validatedData['status']); // Menghapus status dari data yang akan diupdate
    }

    // Buat objek Agreement baru
    $updatedAgreement = new Agreement($validatedData);
    
    // Set agreement_files pada objek yang baru
    $updatedAgreement->agreement_files = $agreementFiles;

    // Simpan objek yang baru ke database
    $agreement->update($updatedAgreement->toArray());

    return redirect()->route('schools.show', $agreement->school)->with('success', 'Perjanjian berhasil diperbarui.');
    }

    public function print(Agreement $agreement)
    {
        // Mengambil data Agreement yang sudah Anda lewatkan sebagai parameter
        $agreementData = $agreement;
    
        // Render template surat SPK dan mengganti dengan data Agreement
        $html = view('agreements.surat-spk', compact('agreementData'))->render();
    
        // Cetak surat menggunakan library PDF (contoh dengan Dompdf)
        $pdf = PDF::loadHTML($html);
    
        // Mengatur nama file hasil cetakan
        $filename = 'PERJANJIAN SPK_' . $agreementData->agreements_number . '.pdf';
    
        // Mengirimkan dokumen PDF ke browser untuk ditampilkan atau diunduh
        return $pdf->stream($filename);
    }
    
    public function destroy(Agreement $agreement)
    {
        // Menghapus file-file terkait dengan perjanjian dari penyimpanan
        foreach ($agreement->agreement_files as $file) {
            Storage::disk('public')->delete('agreement_files/' . $file);
        }

        // Menghapus perjanjian dari database
        $agreement->delete();

        return redirect()->route('schools.show', $agreement->school)->with('success', 'Perjanjian berhasil dihapus.');
    }

}
