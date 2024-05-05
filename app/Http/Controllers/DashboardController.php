<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Property;
use App\Models\Acquisition;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->take(5);

        return inertia('Dashboard', [
            'properties' => $properties,
            'categoriesCount' => Category::count(),
            'employeesCount' => Employee::count(),
            'acquisitionsCount' => Acquisition::count(),
            'officesCount' => Office::count(),
            'propertiesCount' => Property::count(),
        ]);
    }
}
