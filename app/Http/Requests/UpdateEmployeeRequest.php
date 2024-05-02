<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_no' => ['required',Rule::unique(Employee::class)->ignore($this->employee)],
            'fname' => ['required','string'],
            'mname' => ['required','string'],
            'lname' => ['required','string'],
            'address' => ['required','string'],
            'emp_type' => ['required','string'],
            'status' => ['required'],
            'role' => ['required','string'],
            'profile_photo' => ['nullable','image:png,jpeg,jpg','max:5120'],
        ];
    }

    public function messages()
    {
        return [
            'id_no.required' => 'The id number field is required.',
            'id_no.unique' => 'The id number field has already been taken.',
            'fname.required' => 'The first name field is required.',
            'fname.string' => 'The first name field must be a string.',
            'mname.required' => 'The middle name field is required.',
            'mname.string' => 'The middle name field must be a string.',
            'lname.required' => 'The last name field is required.',
            'lname.string' => 'The last name field must be a string.',
            'emp_type.required' => 'The employee type field is required.',
        ];
    }
}
