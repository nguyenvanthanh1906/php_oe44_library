<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use \Datetime;

class CurrentDayRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {      

        return (strtotime(date("d-m-Y")) <= strtotime($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return trans('requests.notearlythancurrentday');
    }
}
