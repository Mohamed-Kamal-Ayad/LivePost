<?php

namespace App\Http\Requests;

use App\Rules\IntegarArray;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user_ids' => [
                'required',
                'array',
                'exists:users,id',
                new IntegarArray(),
//                function ($attribute, $value, $fail): void {
                //$integarOnly = collect($value)->every(fn($item) => is_int($item));
                //if (!$integarOnly) {
                //$fail($attribute . ' must be integer');
                //}

//                    foreach ($value as $userId) {
//                        if (!is_int($userId)) {
//                            $fail($attribute . ' must be integer');
//                        }
//                    }
//                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'body.required' => 'Body is required',
            'user_ids.required' => 'User ids is required',
            'user_ids.array' => 'User ids must be an array',
            'title.max' => 'Title must be less than 255 characters',
            'title.string' => 'Title must be a string',
            'body.string' => 'Body must be a string',
        ];
    }
}
