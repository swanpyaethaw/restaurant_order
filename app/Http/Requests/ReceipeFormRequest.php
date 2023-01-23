<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceipeFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg'
        ];
    }
}
