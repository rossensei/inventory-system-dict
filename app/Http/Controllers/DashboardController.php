<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Property;
use App\Models\Acquisition;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = Property::with(['category', 'acquisition', 'office', 'receivedBy', 'assignedTo'])
            ->latest()
            ->take(5)
            ->get();

        return inertia('Dashboard', [
            'properties' => PropertyResource::collection($properties),
            'categoriesCount' => Category::count(),
            'employeesCount' => Employee::count(),
            'acquisitionsCount' => Acquisition::count(),
            'officesCount' => Office::count(),
            'propertiesCount' => Property::count(),
        ]);
    }
}
