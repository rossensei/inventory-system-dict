<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Resources\OfficeResource;
use App\Http\Requests\NewOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('perPage', 10);

        $baseQuery = Office::query();

        $baseQuery->when($request->input('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('office_name', 'LIKE', "%{$search}%")
                    ->orWhere('classification', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        });

        $baseQuery->when($request->input('classification'), function ($query, $classification) {
            if($classification === 'DICT-DTC') {
                $query->where('classification', 'DICT-DTC');
            } else {
                $query->where('classification', 'Tech4ED Center');
            }
        });

        $collection = $baseQuery->paginate($per_page)->withQueryString();

        $offices = OfficeResource::collection($collection);

        return inertia('Office/Index', [
            'offices' => $offices,
            'filters' => $request->only(['search', 'classifications'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Office/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewOfficeRequest $request)
    {
        $request->validated();

        Office::create($request->all());

        return redirect(route('office.index'))->with('success', 'New office has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        return inertia('Office/Edit', [
            'office' => OfficeResource::make($office),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $request->validated();
        $office->update($request->all());
        return redirect(route('office.index'))->with('success', 'Office details has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return back()->with('success', 'Office has been deleted!');
    }
}
