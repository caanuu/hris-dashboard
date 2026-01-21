<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        // Ambil data karyawan beserta relasinya
        $employees = Employee::with(['user', 'department', 'position'])->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        // Ambil data untuk dropdown di form
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // Cek email unik di tabel users
            'nip' => 'required|unique:employees',     // Cek NIP unik di tabel employees
            'department_id' => 'required',
            'position_id' => 'required',
            'join_date' => 'required|date',
        ]);

        // 2. Buat Akun User Dulu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'), // Default password
            'role' => 'karyawan'
        ]);

        // 3. Simpan Data Detail Karyawan
        Employee::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'address' => $request->address,
            'join_date' => $request->join_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Data Karyawan Berhasil Disimpan!');
    }
}
