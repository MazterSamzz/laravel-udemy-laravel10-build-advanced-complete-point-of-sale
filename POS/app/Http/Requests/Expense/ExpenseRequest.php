<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $date = explode('-', $this->input('date'));
        $year = $date[0];
        $month = $date[1];

        $this->merge([
            'amount' => intval($this->input('amount')),
            'year' => intval($year),
            'month' => intval($month)
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
            'details' => ['nullable', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'year' => ['required', 'numeric', 'min:1900'],
            'month' => ['required', 'numeric', 'min:0', 'max:12'],
        ];
    }
}
