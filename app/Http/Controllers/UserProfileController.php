<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EmployeeCollection;

class UserProfileController extends Controller
{
    public function edit()
    {
        $employee = Auth::user()->employee;
            
        $userInfo = [
            'id' => $employee->id,
            'user_id' => $employee->user_id,
            'id_no' => $employee->id_no,
            'fname' => $employee->fname,
            'mname' => $employee->mname,
            'lname' => $employee->lname,
            'address' => $employee->address,
            'emp_type' => $employee->emp_type,
            'profile_photo' => $employee->profile_photo,
            'profile_photo_url' => $employee->profile_photo ? asset('storage/uploads/profile_photos/' . $employee->profile_photo) : asset('/images/default-user-icon.jpg'),
            'status' => $employee->status,
        ];
        // $credentials = User::where('id', $authenticatedUser->id)
        //     ->select('id', 'username')
        //     ->first();

        return inertia('CustomProfile/Edit', [
            'userInfo' => $userInfo,
            // 'credentials' => $credentials
        ]);
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $user->employee()->update($attributes);

        return back()->with('success', 'Your profile information has been updated!');
    }

    public function photoUpdate(Request $request) {

        $request->validate([
            'photo' => ['image:png,jpeg,jpg','max:5120']
        ]);

        $employee = Employee::where('user_id', auth()->user()->id)->first();

        //delete if user has existing profile photo
        if($employee->profile_photo) {
            File::delete(storage_path('app/public/uploads/profile_photos/'.$employee->profile_photo));
        }
        
        // process photo
        $destination_path = 'public/uploads/profile_photos';
        $photo_name = time().'.'.$request->photo->extension();
        $request->photo->storeAs($destination_path, $photo_name);
        $employee->update(['profile_photo' => $photo_name]);

        return back()->with('success', 'Your profile picture has been updated!');
    }

    public function deletePhoto()
    {
        $emp = Employee::where('user_id', auth()->user()->id)->first();

        $emp->update(['profile_photo_path' => null]);

        return back()->with('success', 'Your profile photo has been deleted.');
    }
}
