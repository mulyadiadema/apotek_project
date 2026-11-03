<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StaffApotek;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffApotekApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Data staf apotek berhasil diambil.',
            'data' => StaffApotek::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_staff' => 'required|string|max:50|unique:staff_apoteks,id_staff',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20'
        ]);

        $staff = StaffApotek::create($validated);

        return response()->json([
            'message' => 'Staf apotek berhasil ditambahkan.',
            'data' => $staff
        ], 201);
    }

    public function show(string $id)
    {
        $staff = StaffApotek::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Staf apotek tidak ditemukan.'], 404);
        }

        return response()->json([
            'message' => 'Detail staf apotek berhasil diambil.',
            'data' => $staff
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $staff = StaffApotek::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Staf apotek tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'id_staff' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('staff_apoteks', 'id_staff')->ignore($staff->id)],
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'tanggal_lahir' => 'sometimes|required|date',
            'tempat_lahir' => 'sometimes|required|string|max:100',
            'no_hp' => 'sometimes|required|string|max:20'
        ]);

        $staff->update($validated);

        return response()->json([
            'message' => 'Data staf apotek berhasil diperbarui.',
            'data' => $staff
        ], 200);
    }

    public function destroy(string $id)
    {
        $staff = StaffApotek::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Staf apotek tidak ditemukan.'], 404);
        }

        $staff->delete();

        return response()->json(['message' => 'Staf apotek berhasil dihapus.'], 200);
    }
}