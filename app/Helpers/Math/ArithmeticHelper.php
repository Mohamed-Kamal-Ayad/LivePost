<?php

namespace App\Helpers\Math;

use http\Exception\InvalidArgumentException;

class ArithmeticHelper
{
    public static function add(...$nums)
    {
        if (sizeof($nums) < 1) {
            throw new \InvalidArgumentException("Must Have at least 1 arguments");
        }
        $sum = 0;
        foreach ($nums as $num) {
            if (!(is_float($num) || is_int($num))) {
                throw new \InvalidArgumentException("Argument only numbers");
            }
            $sum += $num;
        }
        return $sum;
    }

    public static function minus()
    {

    }
}
