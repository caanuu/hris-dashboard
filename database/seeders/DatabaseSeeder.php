<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Departemen
        $dept1 = Department::create(['name' => 'Plantation Forestry']);
        $dept2 = Department::create(['name' => 'Mill Operations']);
        $dept3 = Department::create(['name' => 'Human Resources (HR)']);
        $dept4 = Department::create(['name' => 'General Affair']);

        // 2. Buat Jabatan
        $pos1 = Position::create(['title' => 'General Manager', 'salary' => 25000000]);
        $pos2 = Position::create(['title' => 'Supervisor', 'salary' => 12000000]);
        $pos3 = Position::create(['title' => 'Staff Admin', 'salary' => 6000000]);
        $pos4 = Position::create(['title' => 'Operator Lapangan', 'salary' => 5500000]);

        // 3. Buat User Admin & Karyawan Dummy
        // Admin
        User::create([
            'name' => 'Admin HR',
            'email' => 'admin@tpl.co.id',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Karyawan 1 (Budi - Manager)
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@tpl.co.id',
            'password' => Hash::make('password'),
            'role' => 'karyawan'
        ]);
        $emp1 = Employee::create([
            'user_id' => $user1->id,
            'department_id' => $dept1->id,
            'position_id' => $pos1->id,
            'nip' => 'TPL-2023001',
            'phone' => '081234567890',
            'address' => 'Porsea, Toba',
            'join_date' => '2020-01-10'
        ]);

        // Karyawan 2 (Siti - Staff)
        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@tpl.co.id',
            'password' => Hash::make('password'),
            'role' => 'karyawan'
        ]);
        $emp2 = Employee::create([
            'user_id' => $user2->id,
            'department_id' => $dept3->id,
            'position_id' => $pos3->id,
            'nip' => 'TPL-2024005',
            'phone' => '082233445566',
            'address' => 'Balige, Toba',
            'join_date' => '2023-05-15'
        ]);

        // 4. Buat Dummy Absensi Hari Ini
        Attendance::create([
            'employee_id' => $emp1->id,
            'date' => Carbon::today(),
            'time_in' => '07:55:00',
            'status' => 'hadir'
        ]);

        Attendance::create([
            'employee_id' => $emp2->id,
            'date' => Carbon::today(),
            'time_in' => '08:05:00',
            'status' => 'hadir'
        ]);
    }
}
