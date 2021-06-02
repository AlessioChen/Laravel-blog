<?php

namespace App\traits;

trait ValidationTrait
{
    /**
     *   create an array with query string paramaters
     */
    protected function prepareForValidation()
    {
        if ($this->has('with')) {
            $this->merge(['with' => explode(',', $this->with)]);
        }


    }


}
