<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Office;
use App\Models\Employee;
use App\Models\Property;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Resources\PropertyResource;

class ReportController extends Controller
{
    public function index() {
        $offices = Office::select('id', 'office_name')
            ->orderBy('office_name', 'asc')
            ->get();
        $employees = Employee::select('id', 'fname', 'lname')
            ->orderBy('fname', 'asc')
            ->orderBy('lname', 'asc')
            ->get();

        return inertia('Reports/Index', [
            'offices' => $offices,
            'employees' => $employees
        ]);
    }

    public function inventorySummary()
    {
        $properties = Property::with(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee'])->get();

        $pdf = Pdf::loadView('reports.inventory-summary', [ 'properties' => PropertyResource::collection($properties), 'date_generated' => Carbon::now()->toDateString()])
            ->setPaper('a3','landscape');

        return $pdf->download(time() ." - Inventory Report Summary.pdf");
    }

    public function inventoryServiceable()
    {
        $properties = Property::where('status', 'Serviceable')
            ->with(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee'])
            ->get();

        $pdf = Pdf::loadView('reports.serviceable-inventory', [ 'properties' => PropertyResource::collection($properties), 'date_generated' => Carbon::now()->toDateString()])
            ->setPaper('a3','landscape');

        return $pdf->download(time() ." - Serviceable Inventory.pdf");
    }

    public function inventoryUnserviceable()
    {
        $properties = Property::where('status', 'Unserviceable')
            ->with(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee'])
            ->get();

        $pdf = Pdf::loadView('reports.unserviceable-inventory', [ 
            'properties' => PropertyResource::collection($properties), 
            'date_generated' => Carbon::now()->toDateString()
        ])->setPaper('a3','landscape');

        return $pdf->download(time() ." - Unserviceable Inventory.pdf");
    }

    public function inventoryPerOffice(Office $office)
    {

        if(!$office->properties()->exists()) {
            session()->flash('error', 'Office has no existing properties. Nothing to be generated!');

            return;
        }

        $properties = $office->properties;

        $properties->load(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee']);

        $pdf = Pdf::loadView('reports.inventory-per-office', [ 
            'office' => $office,
            'properties' => PropertyResource::collection($properties), 
            'date_generated' => Carbon::now()->toDateString()
        ])->setPaper('a3','landscape');

        return $pdf->download(time() ." - " . $office->office_name . " Inventory.pdf");
    }

    public function inventoryPerEmployee(Employee $employee)
    {
        $properties = $employee->properties;

        $properties->load(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee']);

        $pdf = Pdf::loadView('reports.inventory-per-office', [ 
            'office' => $office,
            'properties' => PropertyResource::collection($properties), 
            'date_generated' => Carbon::now()->toDateString()
        ])->setPaper('a3','landscape');

        return $pdf->download(time() ." - " . $office->office_name . " Inventory.pdf");
    }
}
