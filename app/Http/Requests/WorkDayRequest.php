<?php

namespace App\Http\Requests;

use App\Models\Profession;
use Illuminate\Foundation\Http\FormRequest;

class WorkDayRequest extends FormRequest
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
        $profession_table = with(new Profession)->getTable();
        return [
            'name' => ['required', 'string'],
            'profession_id' => ['required', 'integer', "exists:$profession_table,id"],
        ];
    }
}
