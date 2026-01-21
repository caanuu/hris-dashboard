<?php
namespace App\Http\Controllers;
use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee.user', 'employee.position')->latest()->get();
        return view('payroll.index', compact('payrolls'));
    }

    // Fitur Generate Gaji Otomatis (Simpel)
    public function store()
    {
        $employees = Employee::with('position')->get();
        foreach ($employees as $emp) {
            $basic = $emp->position->salary ?? 0; // Ambil gaji dari jabatan
            // Cek apakah bulan ini sudah digaji
            $exists = Payroll::where('employee_id', $emp->id)->where('month', date('M Y'))->exists();

            if (!$exists && $basic > 0) {
                Payroll::create([
                    'employee_id' => $emp->id,
                    'month' => date('M Y'),
                    'basic_salary' => $basic,
                    'net_salary' => $basic, // Sementara sama, belum ada potongan
                ]);
            }
        }
        return back()->with('success', 'Slip gaji bulan ini berhasil digenerate!');
    }
}
