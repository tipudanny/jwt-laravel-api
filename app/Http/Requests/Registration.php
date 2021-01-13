<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class Registration extends FormRequest
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
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|regex:/(01)[0-9]{9}/',
            'dob'       => 'required|date_format:d-m-Y',
            'address'   => 'required|string',
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
            'name.required'     => 'Name shoul not be null',
            'name.string'       => 'Name shoul be String',
            'email.required'    => 'Email shoul not be null',
            'email.email'       => 'Email shoul be email type',
            'email.unique'      => 'A user with this email address already exists.',
            'phone.required'    => 'Phone shoul not be null',
            'phone.regex'       => 'Phone shoul be Numeric',
            'dob.required'      => 'Date of Birth shoul not be null',
            'dob.date_format'   => 'Date Formate shuld be Day-Month-Year (01-12-2000)',
            'address.required'  => 'Address shoul not be Null',
        ];
    }

    public function failedValidation(Validator  $validator) {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }


}
