<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:30|unique:pelanggans,id_pelanggan',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('home')
            ->with('success', 'Data pelanggan berhasil disimpan!');
    }

    public function edit($id)
    {
        return redirect()->route('home', [
            'edit_pelanggan' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:30|unique:pelanggans,id_pelanggan,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('home')
            ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();

        return redirect()->route('home')
            ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
