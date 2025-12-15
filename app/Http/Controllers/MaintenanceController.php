<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Department;
use App\Models\MaintenanceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    // Overzicht van alle machines
    public function index(Request $request)
    {
        $user = Auth::user();
        $onderhoud = Department::where('slug', 'onderhoud')->first();
        if (!($user && ($user->isManager() || ($user->department_id === $onderhoud?->id)))) {
            abort(403);
        }

        $query = Machine::query();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('naam', 'like', "%$q%")
                    ->orWhere('type', 'like', "%$q%")
                    ->orWhere('serienummer', 'like', "%$q%")
                    ->orWhere('specificaties', 'like', "%$q%") ;
            });
        }
        $machines = $query->orderBy('naam')->get();

        // upcoming planned maintenance (next 30 days)
        $upcoming = MaintenanceOrder::whereNotNull('gepland_op')
            ->where('gepland_op', '>=', now()->toDateString())
            ->orderBy('gepland_op')
            ->limit(6)
            ->get();

        return view('maintenance.index', compact('machines', 'upcoming'));
    }

    // Detailpagina voor een machine
    public function show(Machine $machine)
    {
        $user = Auth::user();
        $onderhoud = Department::where('slug', 'onderhoud')->first();
        if (!($user && ($user->isManager() || ($user->department_id === $onderhoud?->id)))) {
            abort(403);
        }

        $machine->load(['onderhoudsorders' => function($q) { $q->orderBy('gepland_op', 'desc'); }, 'logs']);

        return view('maintenance.show', compact('machine'));
    }
}
