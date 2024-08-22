<?php

namespace App\Http\Requests\AdvanceSalary;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvanceSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('amount'))
            $amount = str_replace(',', '', $this->input('amount')); // Menghapus koma

        $this->merge([
            'month' => intval($this->input('month')),
            'year' => intval($this->input('year')),
            'amount' => intval($amount)
        ]);
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
            'month' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
        ];
    }
}
