<?php

namespace App\Modules\Management\VideoManagement\Video\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
{
    public function authorize(): bool { return true; }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response(['status' => 'validation_error', 'errors' => $validator->errors()->getMessages()], 422)
        );
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|string|max:500',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'sort_order'  => 'nullable|integer',
            'status'      => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
