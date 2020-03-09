<?php

class ArrayDigitTest extends \PHPUnit\Framework\TestCase
{
    public function testIncrement()
    {
        $arrayDigit = ArrayDigit::createWithInteger(185);
        $arrayDigit = ArrayDigit::increment($arrayDigit);
        $this->assertEquals(186, $arrayDigit->getIntValue());
    }

    /**
     * @dataProvider postiveNumberProvide
     */
    public function testIncrementEquality($i)
    {
        $this->assertEquals(ArrayDigit::createWithInteger($i + 1), ArrayDigit::increment(ArrayDigit::createWithInteger($i)));
    }

    public function testMaxIntValue()
    {
        $this->assertEquals(
            ArrayDigit::createWithClassicalArray([9, 2, 2, 3, 3, 7, 2, 0, 3, 6, 8, 5, 4, 7, 7, 5, 8, 0, 8]),
            ArrayDigit::increment(ArrayDigit::createWithInteger(PHP_INT_MAX))
        );
    }

    public function testNegativeNumber()
    {
        $exception = false;
        try {
            ArrayDigit::createWithInteger(-1);
        } catch (LogicException $e) {
            $exception = true;
        }
        $this->assertTrue($exception);
    }

    public function postiveNumberProvide()
    {
        $result = [];
        for ($i = 0; $i <= 1000; ++$i) {
            $result[] = [$i];
        }

        return $result;
    }
}
