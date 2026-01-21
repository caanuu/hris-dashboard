<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Guarded kosong berarti semua kolom boleh diisi lewat create()
    protected $guarded = [];

    // Relasi ke User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Department (Divisi)
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relasi ke Position (Jabatan)
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
