<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use App\Models\ProfessionCategory;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class ProfessionRequest extends FormRequest
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
        $profession_category_table = with(new ProfessionCategory())->getTable();
        $tag_table = with(new Tag())->getTable();
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_id' => ['nullable', 'integer', "exists:$attachment_table,id"],
            'salary' => ['required', 'integer', 'min:0'],
            'salary_up' => ['nullable', 'integer', 'min:0'],
            'salary_down' => ['nullable', 'integer', 'min:0'],
            'categories' => ['array'],
            'categories.*.id' => ['required', 'integer', "exists:$profession_category_table,id"],
            'tags' => ['array'],
            'tags.*.id' => ['required', 'integer', "exists:$tag_table,id"],
            'popularity' => ['nullable', 'integer', 'min:0', 'max:100'],
            'demand' => ['nullable', 'integer', 'min:0', 'max:100'],
            'perspective' => ['nullable', 'integer', 'min:0', 'max:100'],
            'demand_change' => ['nullable', 'boolean'],
        ];
    }
}
