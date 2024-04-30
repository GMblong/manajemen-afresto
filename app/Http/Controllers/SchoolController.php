<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Carbon\Carbon;

class SchoolController extends Controller
{
    public function index()
    {
        $berlanggananCount = School::where('status', 'Berlangganan')->count();
        $prosesSPKCount = School::where('status', 'Proses SPK')->count();
        $putusKontrakCount = School::where('status', 'Putus Kontrak')->count();
        $totalSekolah = $berlanggananCount + $prosesSPKCount;
        $persentase = $totalSekolah > 0 ? ($berlanggananCount / $totalSekolah) * 100 : 0;

        $schools = School::all();

        return view('schools.index', compact('berlanggananCount', 'prosesSPKCount', 'putusKontrakCount','persentase', 'schools'));
    }
    public function create()
    {
        return view('schools.create');
    }
    


    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'name' => 'required|string',
        'address' => 'required',
        'city' => 'nullable|string',
        'phone_number' => 'required|string',
        'headmaster_name' => 'required|string',
        'url' => 'nullable|string',
        'status' => 'in:Berlangganan,Proses SPK,Putus Kontrak,Selesai',
    ]);

    // Simpan data sekolah ke database.
    $school = new School($validatedData);
    $school->save();

    return redirect()->route('schools.index');
    }

    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        return $this->storeOrUpdate($request, $school);
    }

    public function destroy(School $school)
    {
        try{
            $school->agreements()->delete();
            $school->schoolFinancePackages()->delete();
            $school->delete();

            return redirect()->route('schools.index')->with('success', 'Sekolah berhasil di Hapus!');
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during deletion
            return redirect()->route('schools.index')->with('error', 'Sekolah gagal di Hapus!');
        }
    }

    private function storeOrUpdate(Request $request, School $school)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required',
            'city' => 'nullable|string',
            'phone_number' => 'required|string',
            'headmaster_name' => 'required|string',
            'url' => 'nullable|string',
            'status' => 'in:Berlangganan,Proses SPK,Putus Kontrak,Selesai',
        ]);

        $school->update($validatedData);

        return redirect()->route('schools.show', compact('school'));
    }
    public function show(School $school)
    {
        return view('schools.show', compact('school'));
    }
    
    
}