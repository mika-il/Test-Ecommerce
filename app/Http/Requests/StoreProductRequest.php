<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|numeric|not_in:0',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:1000'
        ];
    }
}
