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
        return inertia('Dashboard', [
            'categoriesCount' => Category::count(),
            'employeesCount' => Employee::count(),
            'acquisitionsCount' => Acquisition::count(),
            'officesCount' => Office::count(),
            'propertiesCount' => Property::count(),
        ]);
    }
}
