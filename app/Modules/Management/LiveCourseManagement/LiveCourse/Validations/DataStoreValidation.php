<?php

namespace App\Modules\Management\LiveCourseManagement\LiveCourse\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required | sometimes',
            'description' => 'required | sometimes',
            'live_course_type' => 'required | sometimes',
            'promo_video_url' => 'required | sometimes',
            'course_features' => 'sometimes',
            'course_specification' => 'sometimes',
            'course_duration' => 'required | sometimes',
            'thumbnail' => 'sometimes|file|mimes:jpg,jpeg,png,gif|max:2048 ',
            'total_seats' => 'required | sometimes',
            'regular_price' => ' sometimes',
            'sale_price' => 'required | sometimes',
            'discount_percent' => 'required | sometimes',
            'installment_months' => 'required | sometimes',
            'is_popular' => 'required | sometimes',
            'sort_order' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
