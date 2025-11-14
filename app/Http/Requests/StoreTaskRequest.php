<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreTaskRequest extends FormRequest
{
    public function authorize() { return auth()->check(); }

    public function rules()
    {
        return [
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'status' => ['required', Rule::in(['Pending','In Progress','Completed'])],
            'due_date' => ['nullable','date','after_or_equal:today'],
        ];
    }

    public function messages()
    {
        return [
            'due_date.after_or_equal' => 'Due date must be today or a future date.',
        ];
    }
}
