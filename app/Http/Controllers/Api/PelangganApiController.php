<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Data pelanggan berhasil diambil.',
            'data' => Pelanggan::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:50|unique:pelanggans,id_pelanggan',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20'
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'message' => 'Pelanggan berhasil ditambahkan.',
            'data' => $pelanggan
        ], 201);
    }

    public function show(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan.'], 404);
        }

        return response()->json([
            'message' => 'Detail pelanggan berhasil diambil.',
            'data' => $pelanggan
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'id_pelanggan' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('pelanggans', 'id_pelanggan')->ignore($pelanggan->id)],
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'no_hp' => 'sometimes|required|string|max:20'
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'message' => 'Data pelanggan berhasil diperbarui.',
            'data' => $pelanggan
        ], 200);
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan.'], 404);
        }

        $pelanggan->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus.'], 200);
    }
}