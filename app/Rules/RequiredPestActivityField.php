<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredPestActivityField implements Rule
{
    private $is_pest_activity;
    private $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($is_pest_activity, $type)
    {
         $this->is_pest_activity = $is_pest_activity;
         $this->type = $type;
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
        if($this->type == 'Field Audit' && $this->is_pest_activity == 1){
            if($value == '')
                return true;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The pests list field is required.';
    }
}
