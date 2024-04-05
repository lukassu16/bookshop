<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|max:255',
            'price'     => 'numeric|min:0',
            'type'      => 'required|max:255',
            'author_id' => 'required|exists:authors,id',
            'attributes' => "array:{$this->getAvailableAttributes()}"
        ];
    }

    public function messages(): array
    {
        return [];
    }

    /**
     * Get available options based on the type
     *
     * @return array
     */
    private function getAvailableAttributes()
    {
        $type = ucfirst($this->input('type'));

        if (class_exists("App\\Models\\$type")) {
            return implode(",", forward_static_call(["App\\Models\\$type", 'getAvailableOptions']));
        } else {
            return implode(",", []);
        }
    }
}
