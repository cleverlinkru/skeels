<?php

namespace App\Http\Requests;

use App\Models\WorkDay;
use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
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
        $work_day_table = with(new WorkDay())->getTable();
        return [
            'work_day_id' => ['required', 'integer', "exists:$work_day_table,id"],
        ];
    }
}
