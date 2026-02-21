<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //set to true because there are no users in this app 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $method = $this->method();
        if ($method == "PUT") {
            return [
                'Name' => ['required', 'min:2'],
                'Email' => ['required', 'email'],
                'Source' => ['required', Rule::in(['website', 'e-mail', 'telefoon', 'whatsapp', 'showroom', 'overig',])],
                'Status' => ['required', Rule::in(['nieuw', 'opgepakt', 'proefrit', 'offerte', 'verkocht', 'afgevallen',])],
            ];
        } else {
            // 'sometimes' rule makes it so that if the field is not present, it won't be checked for validation (mostly for patch requests)
            return [
                'Name' => ['sometimes', 'required', 'min:2'],
                'Email' => ['required', 'email', 'unique:leads,Email'],
                'Source' => ['sometimes', 'required', Rule::in(['website', 'e-mail', 'telefoon', 'whatsapp', 'showroom', 'overig',])],
                'Status' => ['sometimes', 'required', Rule::in(['nieuw', 'opgepakt', 'proefrit', 'offerte', 'verkocht', 'afgevallen',])],
            ];
        }
    }
}
