<?php

namespace Roberts\Leads\Exceptions;

use Exception;

class InvalidLeadProperty extends Exception
{
    public static function create($propertyName)
    {
        return new static("{$propertyName} is not a valid property name.");
    }
}
