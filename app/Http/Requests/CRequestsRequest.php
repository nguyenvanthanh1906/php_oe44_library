<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentDayRule;
use App\Rules\BorrowDayRule;
use App\Rules\ReturnDayRule;

class CRequestsRequest extends FormRequest
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
            'borrowday' => ['required', new CurrentDayRule(), new BorrowDayRule($this->input('returnday')),],
            'returnday' => ['required', new CurrentDayRule(), new ReturnDayRule($this->input('borrowday')),],
        ];
    }
}
