<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertContactFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'expert_id' => 'bail|required|integer',
            'name' => 'bail|required|string',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|string',
            'unit_and_job_title' => 'bail|required|string',
            'content' => 'bail|required|string',
        ];
    }
}