<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BranchUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'required|string',
            'address'        => 'required|string',
            'branch_id'      => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

            'name.required'           => 'Please enter branch name.',
            'name.string'             => 'Branch name should be string.',
            'address.required'        => 'Please enter branch address.',
            'address.string'          => 'Branch address should be string.',
            'branch_id.required'      => 'Provide a Valid Branch ID.',
            'branch_id.string'        => 'Branch ID should be integer.',

        ];
    }

    public function failedValidation(Validator  $validator) {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
