<?php

namespace App\Http\Requests\Salary;

use App\Models\Backend\Salary;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepares the request data for validation by cleaning and converting the amount value.
     *
     * If the request contains a 'amount' field, this method removes any commas from the value and converts it to an integer.
     * The cleaned amount value is then merged back into the request data.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('amount')) {
            $amount = $this->input('amount');
            $amount = str_replace(',', '', $amount); // Menghapus koma
            $amount = intval($amount);

            $this->merge([
                'amount' => $amount,
            ]);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'month' => ['required', 'min:1', 'max:12'],
            'year' => ['required', 'min:1', 'max:9999'],
            'amount' => ['required', 'min:0']
        ];
    }
}
