<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use Illuminate\Foundation\Http\FormRequest;

class ProfessionCategoryRequest extends FormRequest
{
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->image_id && Attachment::where(['id' => $this->image_id, 'user_id' => $this->user()->id])->count() == 0) {
                $validator->errors()->add('image_id', 'No access');
            }
        });
    }

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
        $attachment_table = with(new Attachment())->getTable();
        return [
            'name' => ['required', 'string'],
            'image_id' => ['nullable', 'integer', "exists:$attachment_table,id"],
        ];
    }
}
