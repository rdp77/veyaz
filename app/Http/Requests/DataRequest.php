<?php

namespace App\Http\Requests\Item;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DataRequest extends FormRequest
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
            'name' => 'required|unique:items',
            'relations.taxes' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'name.unique' => 'name was used, please change',
            'relations.taxes.array' => 'taxes type data must be array',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'messages' => $validator->messages()
        ], 400);

        throw new HttpResponseException($response);
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'You are not authorized to access this resource'
        ], 403));
    }
}