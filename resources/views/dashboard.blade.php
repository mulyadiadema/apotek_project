<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aplikasi Apotek</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7f5;
            margin: 0;
            padding: 30px 15px;
            color: #222;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        header {
            background: #fff;
            padding: 22px 28px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 5px solid #4c9654;
        }

        header h2 {
            margin: 0 0 7px;
            font-size: 23px;
        }

        header p {
            color: #777;
            margin: 0;
            font-size: 13px;
        }

        .card {
            background: #fff;
            padding: 25px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 15px;
            max-width: 400px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 7px;
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #82a96f;
            border-radius: 3px;
            outline: none;
            font-size: 14px;
        }

        input:focus, textarea:focus {
            border-color: #3974c5;
            box-shadow: 0 0 3px #3974c5;
        }

        textarea {
            resize: vertical;
            min-height: 65px;
        }

        .btn {
            border: none;
            border-radius: 6px;
            padding: 11px 22px;
            color: white;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #3974c5;
        }

        .btn-warning {
            background: #e5a52b;
            color: #222;
        }

        .btn-danger {
            background: #d94b4b;
        }

        .btn-secondary {
            background: #777;
        }

        .btn-small {
            padding: 7px 10px;
            font-size: 12px;
            margin: 2px;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 600px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }

        th {
            background: #edf5eb;
        }

        .alert {
            padding: 13px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .success {
            background: #d9f2df;
            color: #236b35;
        }

        .error {
            color: #b42318;
            font-size: 12px;
            margin-top: 5px;
        }

        .edit-info {
            background: #fff4d6;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .empty {
            color: #888;
            font-size: 13px;
            padding: 15px;
        }

        footer {
            text-align: center;
            color: #888;
            font-size: 12px;
            padding: 20px;
        }

        @media(max-width: 600px) {
            body {
                padding: 15px 10px;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header>
        <h2>APLIKASI APOTEK</h2>
        <p>Sistem Informasi Pengelolaan Data Apotek</p>
    </header>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert" style="background:#ffe2e2;color:#a22;">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- DATA PELANGGAN --}}

    <section class="card">

        <h3>Data Pelanggan</h3>

        @if($editPelanggan)
            <div class="edit-info">
                Anda sedang mengedit data pelanggan.
            </div>
        @endif

        <form
            action="{{ $editPelanggan
                ? route('pelanggan.update', $editPelanggan->id)
                : route('pelanggan.store') }}"
            method="POST"
        >

            @csrf

            @if($editPelanggan)
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Id Pelanggan</label>
                <input
                    type="text"
                    name="id_pelanggan"
                    value="{{ old('id_pelanggan', $editPelanggan?->id_pelanggan) }}"
                    placeholder="Masukkan ID pelanggan"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $editPelanggan?->nama) }}"
                    placeholder="Masukkan nama"
                    required
                >
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat"
                    required
                >{{ old('alamat', $editPelanggan?->alamat) }}</textarea>
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $editPelanggan?->no_hp) }}"
                    placeholder="Masukkan nomor HP"
                    required
                >
            </div>

            <button class="btn btn-primary" type="submit">
                {{ $editPelanggan ? 'Update' : 'Simpan' }}
            </button>

            @if($editPelanggan)
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Batal
                </a>
            @endif

        </form>


        <div class="table-wrapper">
            <h3>Daftar Pelanggan</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pelanggans as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->id_pelanggan }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $p->id) }}"
                                   class="btn btn-warning btn-small">
                                    Edit
                                </a>

                                <form action="{{ route('pelanggan.destroy', $p->id) }}"
                                      method="POST"
                                      style="display:inline"
                                      onsubmit="return confirm('Hapus data pelanggan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-small">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data pelanggan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>


    {{-- DATA STAFF --}}

    <section class="card">

        <h3>Data Staf Apotek</h3>

        @if($editStaff)
            <div class="edit-info">
                Anda sedang mengedit data staf apotek.
            </div>
        @endif

        <form
            action="{{ $editStaff
                ? route('staff.update', $editStaff->id)
                : route('staff.store') }}"
            method="POST"
        >

            @csrf

            @if($editStaff)
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Id Staff</label>
                <input
                    type="text"
                    name="id_staff"
                    value="{{ old('id_staff', $editStaff?->id_staff) }}"
                    placeholder="Masukkan ID staf"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $editStaff?->nama) }}"
                    placeholder="Masukkan nama"
                    required
                >
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat"
                    required
                >{{ old('alamat', $editStaff?->alamat) }}</textarea>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input
                    type="date"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $editStaff?->tanggal_lahir?->format('Y-m-d') ?? $editStaff?->tanggal_lahir) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input
                    type="text"
                    name="tempat_lahir"
                    value="{{ old('tempat_lahir', $editStaff?->tempat_lahir) }}"
                    placeholder="Masukkan tempat lahir"
                    required
                >
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $editStaff?->no_hp) }}"
                    placeholder="Masukkan nomor HP"
                    required
                >
            </div>

            <button class="btn btn-primary" type="submit">
                {{ $editStaff ? 'Update' : 'Simpan' }}
            </button>

            @if($editStaff)
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Batal
                </a>
            @endif

        </form>


        <div class="table-wrapper">
            <h3>Daftar Staf Apotek</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Staff</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($staffs as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->id_staff }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td>{{ $s->tanggal_lahir }}</td>
                            <td>{{ $s->tempat_lahir }}</td>
                            <td>{{ $s->no_hp }}</td>
                            <td>
                                <a href="{{ route('staff.edit', $s->id) }}"
                                   class="btn btn-warning btn-small">
                                    Edit
                                </a>

                                <form action="{{ route('staff.destroy', $s->id) }}"
                                      method="POST"
                                      style="display:inline"
                                      onsubmit="return confirm('Hapus data staf ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-small">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data staf apotek.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>


    {{-- DAFTAR OBAT --}}

    <section class="card">

        <h3>Daftar Obat</h3>

        @if($editObat)
            <div class="edit-info">
                Anda sedang mengedit data obat.
            </div>
        @endif

        <form
            action="{{ $editObat
                ? route('obat.update', $editObat->id)
                : route('obat.store') }}"
            method="POST"
        >

            @csrf

            @if($editObat)
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Kode Obat</label>
                <input
                    type="text"
                    name="kode_obat"
                    value="{{ old('kode_obat', $editObat?->kode_obat) }}"
                    placeholder="Masukkan kode obat"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nama Obat</label>
                <input
                    type="text"
                    name="nama_obat"
                    value="{{ old('nama_obat', $editObat?->nama_obat) }}"
                    placeholder="Masukkan nama obat"
                    required
                >
            </div>

            <div class="form-group">
                <label>Stok Obat</label>
                <input
                    type="number"
                    name="stok"
                    min="0"
                    value="{{ old('stok', $editObat?->stok) }}"
                    placeholder="Masukkan jumlah stok"
                    required
                >
            </div>

            <div class="form-group">
                <label>Tanggal Kedaluwarsa / Expired Obat</label>
                <input
                    type="date"
                    name="tanggal_kedaluwarsa"
                    value="{{ old('tanggal_kedaluwarsa', $editObat?->tanggal_kedaluwarsa) }}"
                    required
                >
            </div>

            <button class="btn btn-primary" type="submit">
                {{ $editObat ? 'Update' : 'Simpan' }}
            </button>

            @if($editObat)
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Batal
                </a>
            @endif

        </form>


        <div class="table-wrapper">
            <h3>Data Obat Tersimpan</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Stok</th>
                        <th>Tanggal Kedaluwarsa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($obats as $o)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $o->kode_obat }}</td>
                            <td>{{ $o->nama_obat }}</td>
                            <td>{{ $o->stok }}</td>
                            <td>{{ $o->tanggal_kedaluwarsa }}</td>
                            <td>
                                <a href="{{ route('obat.edit', $o->id) }}"
                                   class="btn btn-warning btn-small">
                                    Edit
                                </a>

                                <form action="{{ route('obat.destroy', $o->id) }}"
                                      method="POST"
                                      style="display:inline"
                                      onsubmit="return confirm('Hapus data obat ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-small">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data obat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>

    <footer>
        Aplikasi Pengelolaan Data Apotek | Laravel & MySQL
    </footer>

</div>

</body>
</html>