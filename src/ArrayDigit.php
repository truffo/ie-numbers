<?php

class ArrayDigit
{
    private $digits;

    /**
     * ArrayDigit constructor.
     */
    public function __construct()
    {
        $this->digits = [];
    }

    public static function createWithInteger(int $i): self
    {
        if ($i < 0) {
            throw new LogicException('Invalid value');
        }
        $v = new ArrayDigit();
        $v->digits = str_split((string) $i);

        return $v;
    }

    public static function createWithClassicalArray(array $v): self
    {
        foreach ($v as $value) {
            if (!is_integer($value) && $value / 10 > 1) {
                throw new LogicException('Invalid value');
            }
        }
        $result = new ArrayDigit();
        $result->digits = $v;

        return $result;
    }

    public function getIntValue(): int
    {
        $reverse = array_reverse($this->digits);
        $factor = 1;
        $result = 0;
        foreach ($reverse as $digit) {
            $result = $digit * $factor + $result;
            $factor *= 10;
        }

        return $result;
    }

    public static function increment(ArrayDigit $v): ArrayDigit
    {
        $reverse = array_reverse($v->digits);

        $result = $reverse;
        $curry = 1;
        foreach ($reverse as $key => $digit) {
            $digit += $curry;
            $curry = intdiv($digit, 10);
            $result[$key] = $digit % 10;
        }

        if (0 !== $curry) {
            $result[$key + 1] = $curry;
        }

        return self::createWithClassicalArray(array_reverse($result));
    }
}
