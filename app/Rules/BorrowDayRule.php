<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BorrowDayRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->param = $param;
    }
    private $param;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        return (strtotime($value) <= strtotime($this->param));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('requests.borrowday');
    }
}
