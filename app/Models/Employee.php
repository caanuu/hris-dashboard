<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi ke User (Login info)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Departemen
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relasi ke Jabatan
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
