<?php

namespace App\Infrastructure\Http\Requests;

use App\Infrastructure\Exceptions\InvalidDownloadRequestException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DownloadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid', 'size:36'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function validationData(): array
    {
        return [
            'uuid' => $this->route('uuid'), // 👈 importante para validar el parámetro de ruta
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new InvalidDownloadRequestException();
    }
}
