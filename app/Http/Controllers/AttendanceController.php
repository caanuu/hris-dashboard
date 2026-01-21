<?php
namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee.user')->latest()->get();
        $employees = Employee::all(); // Untuk dropdown simulasi absen
        return view('attendance.index', compact('attendances', 'employees'));
    }

    public function store(Request $request)
    {
        // Simulasi Absen Masuk
        Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => Carbon::now()->toDateString(),
            'time_in' => Carbon::now()->toTimeString(),
            'status' => 'hadir'
        ]);
        return back()->with('success', 'Berhasil melakukan absensi masuk!');
    }
}
