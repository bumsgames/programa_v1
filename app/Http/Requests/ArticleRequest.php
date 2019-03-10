<?php

namespace Bumsgames\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'nickname' => 'nullable|string|max:40',
            'category' => 'required',
            'name' => 'required|string|max:80',
            'quantity' => 'required|integer|max:100',
            'price_in_dolar' => 'required|max:10000',
            'email' => 'nullable|email|max:100',
        ];
    }

    
}
