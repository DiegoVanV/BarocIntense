<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user->isManager()) {
            abort(403);
        }

        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }


    public function show(Department $department)
    {
        $user = Auth::user();

        if (! $user->isManager() && $user->department_id !== $department->id) {
            abort(403);
        }

        return view('departments.show', compact('department'));
    }

}
