<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        // Extracts the first three letters of the last name, and capitalize it then concatenate with the id number.
        $credentials = [
            'username' => $employee->id_no,
            'password' => bcrypt(strtoupper(substr($employee->lname, 0, 3)).'_'.$employee->id_no) 
        ];

        $user = User::create($credentials);

        $employee->user()->associate($user)->save();
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
