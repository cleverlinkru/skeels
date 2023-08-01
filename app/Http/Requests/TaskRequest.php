<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use App\Models\WorkDay;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        $work_day_table = with(new WorkDay())->getTable();
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'time' => ['nullable', 'integer', 'min:0'],
            'image_id' => ['nullable', 'integer', "exists:$attachment_table,id"],
            'work_day_id' => ['required', 'integer', "exists:$work_day_table,id"],
        ];
    }
}
