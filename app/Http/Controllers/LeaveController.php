<?php
namespace App\Http\Controllers;
use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee.user')->latest()->get();
        $employees = Employee::all();
        return view('leave.index', compact('leaves', 'employees'));
    }

    public function store(Request $request)
    {
        Leave::create($request->all());
        return back()->with('success', 'Pengajuan cuti berhasil dikirim!');
    }

    // Fitur Approve/Reject
    public function update(Request $request, Leave $leave)
    {
        $leave->update(['status' => $request->status]);
        return back()->with('success', 'Status cuti diperbarui!');
    }
}
