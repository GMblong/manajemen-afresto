<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolFinancePackage;
use Illuminate\Http\Request;

class SchoolFinancePackageController extends Controller
{
    public function index()
    {
        $schoolFinancePackages = SchoolFinancePackage::all();
        return view('school_finance_packages.index', compact('schoolFinancePackages'));
    }

    public function create(Request $request)
    {
        $selectedSchoolId = $request->input('school_id');
        $schools = School::all();
    
        return view('school_finance_packages.create', compact('schools', 'selectedSchoolId'));
    }
    

    public function store(Request $request)
    {
        $school = School::find($request->input('school_id')); 
        $validatedData = $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'packages' => 'required|in:Bulanan,Siswa,Bundling Internet',
            'monthly_cost' => 'required|numeric',
            'description' => 'nullable',
            'status_cashback' => 'required|in:Nominal,Persentase,Tidak Ada Cashback',
            'status_tax' => 'nullable|in:Ditanggung,Tidak Ditanggung',
        ]);

        // Ubah "package" menjadi opsi yang sesuai
        // switch ($validatedData['packages']) {
        //     case 'Bulanan':
        //         $validatedData['packages'] = 'Bulanan';
        //         break;
        //     case 'Siswa':
        //         $validatedData['packages'] = 'Siswa';
        //         break;
        //     case 'Bundling Internet':
        //         $validatedData['packages'] = 'Bundling Internet';
        //         break;
        // }

        $schoolFinancePackage = new SchoolFinancePackage($validatedData);
        $schoolFinancePackage->save();

        $school = School::find($validatedData['school_id']);
        $school->status = 'Berlangganan';
        $school->save();

        return redirect()->route('schools.show', ['school' => $validatedData['school_id']]);
    }

    public function edit(SchoolFinancePackage $schoolFinancePackage)
    {
        // Ambil data yang diperlukan
        $schools = School::find($schoolFinancePackage->school_id);
    
        return view('school_finance_packages.edit', compact('schoolFinancePackage', 'schools'));
    }
    
    public function update(Request $request, SchoolFinancePackage $schoolFinancePackage)
    {
        // Validasi input
        $validatedData = $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'packages' => 'required|in:Bulanan,Siswa,Bundling Internet',
            'monthly_cost' => 'required|numeric',
            'description' => 'nullable',
            'status_cashback' => 'nullable|in:Nominal,Persentase,Tidak Ada Cashback',
            'status_tax' => 'nullable|in:Ditanggung,Tidak Ditanggung',
        ]);
    
        // Update data SchoolFinancePackage
        $schoolFinancePackage->update($validatedData);
    
        return redirect()->route('schools.show', ['school' => $schoolFinancePackage->school_id]);
    }
    

    public function destroy(SchoolFinancePackage $school_finance_package)
    {
        $school = $school_finance_package->school;
        $school_finance_package->delete();

        if ($school->schoolFinancePackages->isEmpty()) {
            $school->status = 'Putus Kontrak';
            $school->save();
        }

        return redirect()->route('schools.show', ['school' => $school]);
    }
}
