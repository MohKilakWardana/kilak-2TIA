<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    // GANTI 1234 dengan 4 angka terakhir NIM
    protected $table = 'biodata_1116';

    protected $fillable = [
        'nim', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'no_hp', 'email', 'agama', 'kewarganegaraan', 'status',
        'profesi', 'foto', 'pendidikan', 'pengalaman',
    ];
}
