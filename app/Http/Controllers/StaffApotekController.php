<?php

namespace App\Http\Controllers;

use App\Models\StaffApotek;
use Illuminate\Http\Request;

class StaffApotekController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_staff' => 'required|string|max:30|unique:staff_apoteks,id_staff',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        StaffApotek::create($validated);

        return redirect()->route('home')
            ->with('success', 'Data staf berhasil disimpan!');
    }

    public function edit($id)
    {
        return redirect()->route('home', [
            'edit_staff' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $staff = StaffApotek::findOrFail($id);

        $validated = $request->validate([
            'id_staff' => 'required|string|max:30|unique:staff_apoteks,id_staff,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $staff->update($validated);

        return redirect()->route('home')
            ->with('success', 'Data staf berhasil diperbarui!');
    }

    public function destroy($id)
    {
        StaffApotek::findOrFail($id)->delete();

        return redirect()->route('home')
            ->with('success', 'Data staf berhasil dihapus!');
    }
}
