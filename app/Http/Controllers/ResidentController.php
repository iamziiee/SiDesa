<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $residents = Resident::all();
        return view('pages.resident.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.resident.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validationData = $request->validate([
            'nik' => ['required', 'max:16', 'min:1'],
            'name' => ['required', 'max:25', 'min:5'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:150'],
            'address' => ['required','max:700'],
            'religion' => ['required','max:50'],
            'marital_status' => ['required', Rule::in(['single','married','divorced','windowed'])],
            'phone_number' => ['required','max:13','min:1', 'unique:residents,phone_number'],
            'occupation' => ['required','max:50'],
            'status' => ['required', Rule::in(['active','moved','deseased'])]
            ], [
                'nik.required' => 'NIK wajib diisi.',
                'nik.min' => 'NIK harus terdiri dari 16 karakter.',
                'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
                'name.required' => 'Nama Lengkap wajib diisi.',
                'name.min' => 'Nama Lengkap minimal 5 karakter.',
                'birth_date.required' => 'Tanggal lahir wajib diisi.',
                'birth_date.date' => 'Format tanggal lahir tidak valid.',
                'birth_place.required' => 'Tempat Lahir wajib diisi.',
                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'religion.required' => 'Agama wajib diisi.',
                'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
                'occupation.required' => 'Pekerjaan wajib diisi.',
                // Tambahkan pesan untuk kolom lainnya jika diperlukan
            ]);

        Resident::create($validationData);
        return redirect('/resident')->with('success', 'Data berhasil di tambahkan...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', ['resident' => $resident]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $resident = Resident::findOrFail($id);
        $validated = $request->validate([
                'nik' => ['required', 'max:16', 'min:15'],
                'name' => ['required', 'max:25', 'min:5'],
                'gender' => ['required', Rule::in(['male', 'female'])],
                'birth_date' => ['required', 'string'],
                'birth_place' => ['required', 'max:150'],
                'address' => ['required','max:700'],
                'religion' => ['required','max:50'],
                'marital_status' => ['required', Rule::in(['single','married','divorced','windowed'])],
                'phone_number' => Rule::unique('residents', 'phone_number')->ignore($resident->id),
                'occupation' => ['required','max:50'],
                'status' => ['required', Rule::in(['active','moved','deseased'])]
            ], [
                'nik.required' => 'NIK wajib diisi.',
                'nik.min' => 'NIK harus terdiri dari 16 karakter.',
                'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
                'name.required' => 'Nama Lengkap wajib diisi.',
                'name.min' => 'Nama Lengkap minimal 5 karakter.',
                'birth_date.required' => 'Tanggal lahir wajib diisi.',
                'birth_date.date' => 'Format tanggal lahir tidak valid.',
                'birth_place.required' => 'Tempat Lahir wajib diisi.',
                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'religion.required' => 'Agama wajib diisi.',
                'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
                'occupation.required' => 'Pekerjaan wajib diisi.',
                // Tambahkan pesan untuk kolom lainnya jika diperlukan
            ]);

        Resident::findOrFail($id)->update($validated);
        return redirect('/resident')->with('success', 'Data berhasil di ubah...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect('/resident')->with('success', 'Data berhasil dihapus...');
    }
}
