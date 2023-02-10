<?php

namespace Tests\Unit;

use App\Helpers\Math\ArithmeticHelper;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ArithmeticHelperTest extends TestCase
{
    public function test_add_can_sum_numbers_up()
    {
        $num1 = 5;
        $num2 = 15;
        $sum = $num1 + $num2;
        $result = ArithmeticHelper::add($num1, $num2);
        $this->assertSame($sum, $result, 'Doesn\'t add numbers correctly');
    }

    public function test_add_can_take_in_multiple_numbers()
    {
        $num1 = 5;
        $num2 = 15;
        $num3 = 120;
        $sum = $num1 + $num2 + $num3;
        $result = ArithmeticHelper::add($num1, $num2, $num3);
        $this->assertSame($sum, $result, 'Doesn\'t add numbers correctly');
    }

    public function test_add_can_only_take_in_numeric_arguments()
    {
        $this->expectException(\InvalidArgumentException::class); //why back slash here?
        $result = ArithmeticHelper::add("asdas");
    }

    public function test_add_nees_at_least_one_argument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $result = ArithmeticHelper::add();
    }
}
