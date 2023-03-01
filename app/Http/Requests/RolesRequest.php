<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RolesRequest extends FormRequest
{
    /**
     * Determine if the role is authorized to make this request.
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
    public function rules(): array
    {
        if (Request::route()->getName() == 'roles.store') {
            $role_name = 'unique:roles,role_name';
        } elseif (Request::route()->getName() == 'roles.update') {
            $role_name = Rule::unique('roles', 'role_name')->ignore(
                $this->route('role')
            );
           
        }

        $rules = [
            'role_name' => ['required', 'string', 'max:255', $role_name],
        ];

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_name.required' => 'Kolom Rolename harus di isi',
            'role_name.unique' => 'Rolename yang digunakan sudah dipakai',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            Response::json([
                'status' => 'error',
                'data' => collect($errors)->flatten()->toArray(),
            ], 422)
        );
    }
}
