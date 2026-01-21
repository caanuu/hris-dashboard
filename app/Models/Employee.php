<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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

    // --- TAMBAHAN RELASI BARU (PENTING) ---

    // Relasi ke Absensi (One to Many)
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relasi ke Cuti (One to Many)
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    // Relasi ke Gaji (One to Many)
    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
