<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DownloadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'format' => [
                'required',
                Rule::in(['xml', 'csv']),
            ],
            'fields' => [
                'required',
                'array',
                Rule::in(['author', 'title']),
            ],
        ];
    }
}
