<?php

namespace Bumsgames\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:40',
            'lastname' => 'required|string|max:40',
            'nickname' => 'string|min:7|max:40|unique:clients,nickname,'.$this->id,
            'documento_identidad' => 'string|min:7|max:40|unique:clients,documento_identidad,'.$this->id,
            'email' => 'nullable|email|max:100',
        ];
    }
}
