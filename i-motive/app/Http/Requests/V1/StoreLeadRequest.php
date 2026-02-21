<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
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
    public function rules()
    {
        return [
            'Name' => ['required', 'min:2'],
            'Email' => ['required', 'email', 'unique:leads,Email'],
            'Source' => ['required', Rule::in(['website', 'e-mail', 'telefoon', 'whatsapp', 'showroom', 'overig',])],
            'Status' => ['required', Rule::in(['nieuw', 'opgepakt', 'proefrit', 'offerte', 'verkocht', 'afgevallen',])],
        ];
    }
}
