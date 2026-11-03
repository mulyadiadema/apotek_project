<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_obat' => 'required|string|max:30|unique:obats,kode_obat',
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'tanggal_kedaluwarsa' => 'required|date',
        ]);

        Obat::create($validated);

        return redirect()->route('home')
            ->with('success', 'Data obat berhasil disimpan!');
    }

    public function edit($id)
    {
        return redirect()->route('home', [
            'edit_obat' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'kode_obat' => 'required|string|max:30|unique:obats,kode_obat,' . $id,
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'tanggal_kedaluwarsa' => 'required|date',
        ]);

        $obat->update($validated);

        return redirect()->route('home')
            ->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();

        return redirect()->route('home')
            ->with('success', 'Data obat berhasil dihapus!');
    }
}
