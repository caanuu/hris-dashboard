<?php
namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Position;

class CompanyStructureController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('employees')->get();
        $positions = Position::all();
        return view('structure.index', compact('departments', 'positions'));
    }
}
