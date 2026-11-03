<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffApotek extends Model
{
    protected $table = 'staff_apoteks';

    protected $fillable = [
        'id_staff',
        'nama',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'no_hp'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
