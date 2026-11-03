<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ObatApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Data obat berhasil diambil.',
            'data' => Obat::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_obat' => 'required|string|max:50|unique:obats,kode_obat',
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'tanggal_kedaluwarsa' => 'required|date'
        ]);

        $obat = Obat::create($validated);

        return response()->json([
            'message' => 'Obat berhasil ditambahkan.',
            'data' => $obat
        ], 201);
    }

    public function show(string $id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json(['message' => 'Obat tidak ditemukan.'], 404);
        }

        return response()->json([
            'message' => 'Detail obat berhasil diambil.',
            'data' => $obat
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json(['message' => 'Obat tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'kode_obat' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('obats', 'kode_obat')->ignore($obat->id)],
            'nama_obat' => 'sometimes|required|string|max:255',
            'stok' => 'sometimes|required|integer|min:0',
            'tanggal_kedaluwarsa' => 'sometimes|required|date'
        ]);

        $obat->update($validated);

        return response()->json([
            'message' => 'Data obat berhasil diperbarui.',
            'data' => $obat
        ], 200);
    }

    public function destroy(string $id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json(['message' => 'Obat tidak ditemukan.'], 404);
        }

        $obat->delete();

        return response()->json(['message' => 'Obat berhasil dihapus.'], 200);
    }
}