<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWebsitesRequest extends FormRequest
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
            'url' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'alert_group_id' => 'required|string|max:255'
        ];
    }
}
