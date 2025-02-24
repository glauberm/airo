<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuotationRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => ['required', 'list'],
            'age.*' => ['required', 'integer', Rule::exists('ages', 'age')],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
            'start_date' => ['required', Rule::date()->format('Y-m-d')],
            'end_date' => [
                'required',
                Rule::date()->format('Y-m-d'),
                Rule::date()->afterOrEqual('start_date'),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['age' => explode(',', $this->age)]);
    }
}
