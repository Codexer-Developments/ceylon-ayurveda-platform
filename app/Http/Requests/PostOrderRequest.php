<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostOrderRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required'],
            'center_id' => ['required'],
            'doctor_id' => ['required'],
            'description' => ['required'],
            'date' => ['required'],
            'created_by' => ['required'],
        ];
    }
}
