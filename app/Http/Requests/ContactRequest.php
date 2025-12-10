<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\s\+\-\(\)]+$/',
            'business_type' => 'required|in:cafe,restaurant,fast-food,fine-dining,chain,other',
            'message' => 'required|string|max:2000|min:10',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Name must be at least 2 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'business_type.required' => 'Please select your business type.',
            'business_type.in' => 'Please select a valid business type.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message must not exceed 2000 characters.',
            'phone.regex' => 'Please enter a valid phone number.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'business_type' => 'business type',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Trim whitespace from all string inputs
        $this->merge([
            'name' => trim($this->name ?? ''),
            'email' => trim(strtolower($this->email ?? '')),
            'phone' => trim($this->phone ?? ''),
            'message' => trim($this->message ?? ''),
        ]);
    }
}