<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Property;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Resources\PropertyResource;

class ReportController extends Controller
{
    public function index() {
        return inertia('Reports/Index');
    }

    public function inventorySummary()
    {
        $properties = Property::with(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee'])->get();

        $pdf = Pdf::loadView('reports.inventory-summary', [ 'properties' => PropertyResource::collection($properties), 'date_generated' => Carbon::now()->toDateString()])
            ->setPaper('a3','landscape');

        return $pdf->download("Inventory Report Summary.pdf");
    }

    public function inventoryServiceable()
    {
        $properties = Property::where('status', 'Serviceable')
            ->with(['category', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee'])
            ->get();

        $pdf = Pdf::loadView('reports.inventory-summary', [ 'properties' => PropertyResource::collection($properties), 'date_generated' => Carbon::now()->toDateString()])
            ->setPaper('a3','landscape');

        return $pdf->stream();
    }
}
