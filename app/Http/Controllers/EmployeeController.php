<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'department', 'position'])->latest()->get();
        return view('employees.index', compact('employees'));
    }

    // Tambahkan function ini di dalam class EmployeeController
    public function show(Employee $employee)
    {
        // Load relasi user, department, position, dan history absensi/cuti
        $employee->load(['user', 'department', 'position', 'attendances', 'leaves']);
        return view('employees.show', compact('employee'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nip' => 'required|unique:employees',
            'department_id' => 'required',
            'position_id' => 'required',
            'join_date' => 'required|date',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'role' => 'karyawan'
        ]);

        Employee::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'address' => $request->address,
            'join_date' => $request->join_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    // --- FITUR BARU: EDIT & HAPUS ---

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $employee->user_id,
            'department_id' => 'required',
            'position_id' => 'required',
        ]);

        // Update User Data
        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update Employee Data
        $employee->update([
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('employees.index')->with('success', 'Data karyawan diperbarui');
    }

    public function destroy(Employee $employee)
    {
        // Hapus User (karena cascade, employee juga akan terhapus)
        $employee->user->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
