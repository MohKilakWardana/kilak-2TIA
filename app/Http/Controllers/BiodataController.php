<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    private function rules(): array
    {
        return [
            'nim'             => 'required|string|max:20',
            'nama'            => 'required|string|max:100',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'    => 'nullable|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'alamat'          => 'nullable|string',
            'no_hp'           => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:100',
            'agama'           => 'nullable|string|max:30',
            'kewarganegaraan' => 'nullable|string|max:50',
            'status'          => 'nullable|string|max:30',
            'profesi'         => 'nullable|string|max:100',
            'foto'            => 'nullable|image|max:2048',
            'pendidikan'      => 'nullable|string',
            'pengalaman'      => 'nullable|string',
        ];
    }

    // READ (daftar)
    public function index()
    {
        $data = Biodata::latest()->get();
        return view('biodata.index', compact('data'));
    }

    // READ (detail / tampilan CV)
    public function show(Biodata $biodata)
    {
        return view('biodata.show', compact('biodata'));
    }

    // CREATE (form)
    public function create()
    {
        return view('biodata.create');
    }

    // CREATE (simpan)
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        } else {
            unset($data['foto']);
        }

        Biodata::create($data);
        return redirect()->route('biodata.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // UPDATE (form)
    public function edit(Biodata $biodata)
    {
        return view('biodata.edit', compact('biodata'));
    }

    // UPDATE (simpan)
    public function update(Request $request, Biodata $biodata)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            if ($biodata->foto) {
                Storage::disk('public')->delete($biodata->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        } else {
            unset($data['foto']);
        }

        $biodata->update($data);
        return redirect()->route('biodata.index')->with('success', 'Data berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Biodata $biodata)
    {
        if ($biodata->foto) {
            Storage::disk('public')->delete($biodata->foto);
        }
        $biodata->delete();
        return redirect()->route('biodata.index')->with('success', 'Data berhasil dihapus.');
    }
}
