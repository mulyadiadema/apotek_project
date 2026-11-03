<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\StaffApotek;
use App\Models\Obat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::latest()->get();
        $staffs = StaffApotek::latest()->get();
        $obats = Obat::latest()->get();

        $editPelanggan = $request->query('edit_pelanggan')
            ? Pelanggan::findOrFail($request->query('edit_pelanggan'))
            : null;

        $editStaff = $request->query('edit_staff')
            ? StaffApotek::findOrFail($request->query('edit_staff'))
            : null;

        $editObat = $request->query('edit_obat')
            ? Obat::findOrFail($request->query('edit_obat'))
            : null;

        return view('dashboard', compact(
            'pelanggans',
            'staffs',
            'obats',
            'editPelanggan',
            'editStaff',
            'editObat'
        ));
    }
}
