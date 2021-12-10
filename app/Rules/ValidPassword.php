<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class ValidPassword implements Rule
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
       * Determine if the Length Validation Rule passes.
       *
       * @var boolean
       */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 10);
        //$this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        //$this->uppercasePasses = (Str::lower($value) !== $value);
        //$this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {

              case ! $this->numericPasses:
                  return 'The :attribute must be at least 10 characters and contain at least one number.';

              default:
                  return 'The :attribute must be at least 10 characters.';
          }
    }
}
