<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PickupOrderUpdate extends FormRequest
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
            'id'                    => 'required|numeric',
            'branch_area'           => 'required|numeric',
            'customer_name'         => 'required|string',
            'customer_phone'        => 'required|numeric',

            'product_weight'        => 'required|string',

            'pickup_district'       => 'required|string',
            'pickup_zone'           => 'required|string',
            'pickup_address_line'   => 'required|string',

            'delivery_district'     => 'required|string',
            'delivery_zone'         => 'required|string',
            'delivery_address_line' => 'required|string',

            'delivery_type'         => 'required|string',
            'delivery_charge'       => 'required|numeric',

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

            'id.required'                    => 'Please provide order id for update.',
            'branch_area.required'           => 'Please Select a branch.',
            'customer_name.required'         => 'Please enter a customer name.',
            'customer_phone.required'        => 'Please enter a customer phone.',
            'customer_phone.numeric'         => 'Phone number should be Telephone mo.',

            'product_weight.required'        => 'Please enter a product weight (apporx).',

            'pickup_district.required'       => 'Provide pickup district',
            'pickup_zone.required'           => 'Provide pickup area',
            'pickup_address_line.required'   => 'Provide pickup address line',

            'delivery_district.required'     => 'Provide delivery district',
            'delivery_zone.required'         => 'Provide delivery area',
            'delivery_address_line.required' => 'Provide delivery address line',

            'delivery_type.required'         => 'Select a delivery type.',
            'delivery_charge.required'       => 'Enter delivery charge',
            'delivery_charge.numeric'        => 'Delivery charge should be numeric',

        ];
    }

    public function failedValidation(Validator  $validator) {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
