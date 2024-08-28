<?php

namespace App\Http\Requests\Attendance;

use App\Models\Backend\Attendance;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'attendances.*.id' => ['required', 'exists:attendances,id'],
            'attendances.*.employee_id*' => ['required', 'exists:employees,id'],
            'attendances.*.status*' => ['required', 'in:Present,Leave,Absent'],
        ];
    }
}
