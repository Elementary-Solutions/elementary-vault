<?php

namespace App\Infrastructure\Http\Requests;

use App\Infrastructure\Exceptions\InvalidUploadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UploadJsonFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'string'],
            'file_name' => ['nullable', 'string', 'max:128000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new InvalidUploadRequestException();
    }
}
