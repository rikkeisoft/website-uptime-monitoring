<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlertMethodsRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'alert_group_id' => 'required|string|max:255',
            'type' => 'required|integer|min:1',
            'email' => 'sometimes|required|string|email|max:255',
            'phone_number' => 'sometimes|required|string|max:255',
            'webhook' => 'sometimes|required|string|max:255',
        ];
    }
}
