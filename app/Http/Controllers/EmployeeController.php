<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $per_page =  $request->input('perPage', 10);

        $baseQuery = Employee::query()
            ->with(['user:id', 'user.roles:id,name']);


        $baseQuery->when($request->input('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('fname', 'LIKE', "%{$search}%")
                ->orWhere('mname', 'LIKE', "%{$search}%")
                ->orWhere('lname', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->orWhere('id_no', 'LIKE', "%{$search}%");
            });
        });

        $baseQuery->when($request->input('empType'), function ($query, $empType) {
            if(strcasecmp($empType, 'Plantilla') === 0) {
                $query->where('emp_type', 'Plantilla');
            } else {
                $query->where('emp_type', 'Contract of Service');
            }
        });

        $baseQuery->when($request->input('status'), function ($query, $status) {
            if($status == 'Active') {
                $query->where('status', 'Active');
            } else {
                $query->where('status', 'Inactive');
            }
        });

        $baseQuery->when($request->input('role'), function ($query, $role) {
            $query->whereHas('user.roles', function ($query) use ($role) {
                $query->where('name', $role);
            });
        });

        $employees = $baseQuery->paginate($per_page)
            ->withQueryString();


        return inertia('Employee/Index', [
            'employees' => EmployeeResource::collection($employees),
            'filters' => $request->only(['search', 'perPage', 'empType', 'status', 'role'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Employee/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $fields = $request->validated();
        $selected_role = $fields['role'];

        unset($fields['role']);

        if($request->profile_photo) {
            $destination_path = 'public/uploads/profile_photos';
            $photo_name = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->storeAs($destination_path, $photo_name);
            $fields['profile_photo'] = $photo_name;
        }

        $employee = Employee::create($fields);
        // EmployeeObserver created method fired --> User is processed and created.

        $employee->user->assignRole($selected_role);

        return redirect(route('employee.index'))->with('success', 'A new employee has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $credentials = [
            'username' => $employee->id_no,
            'password' => strtoupper(substr($employee->lname, 0, 3)).'_'.$employee->id_no
        ];

        return inertia('Employee/Credentials', [ 'credentials' => $credentials ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // dd($employee);
        return inertia('Employee/Edit', [
            'employee' => EmployeeResource::make($employee)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $fields = $request->validated();
        $selected_role = $fields['role'];
        unset($fields['role']);

        $user = User::find($employee->user_id);

        if($selected_role != $user->getRoleNames()->first()) {
            $user->roles()->detach();
            $user->assignRole($selected_role);
        }

        if($request->profile_photo) {

            if($employee->profile_photo) {
                File::delete(storage_path('app/public/uploads/profile_photos/'.$employee->profile_photo));
            }
            
            $destination_path = 'public/uploads/profile_photos';
            $photo_name = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->storeAs($destination_path, $photo_name);
            $fields['profile_photo'] = $photo_name;
        } else {
            unset($fields['profile_photo']);
        }

        $employee->update($fields);

        return redirect(route('employee.index'))->with('success', 'Employee details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if($employee->receivedProperties()->exists() || $employee->assignedProperties()->exists()) {
            return back()->with('error', 'You cannot delete this employee!');
        }

        if($employee->profile_photo) {
            File::delete(storage_path('app/public/uploads/profile_photos/'.$employee->profile_photo));
        }

        $employee->delete();
        $employee->user()->delete();

        return back()->with('success', 'Employee has been deleted!');
    }

    public function toggleStatus(Employee $employee)
    {
        $employee->status = !$employee->status;

        $employee->save();

        return back();
    }
}
