<?php

/**
 * Power of mathematical function.
 *
 * @param int $n - number
 * @param int $m - exponent.
 * @return float - float number.
 *
 * @throws Exception
 */
function powerOf(int $n, int $m) : float
{
    if (($n == 0) && ($m < 1))
    {
        throw new Exception("Undefined -> 0^" . $m);
    }

    $result = 1.0;

    if ($m == 0)
    {
        return $result;
    }
    else if ($m > 0)
    {
        for ($i = 0; $i < $m; $i++)
        {
            $result *= $n;
        }
    }
    else
    {
        for ($i = 0; $i > $m; $i--)
        {
            $result *= 1.0 / $n;
        }
    }

    return $result;
}

var_dump(powerOf(2,3));
var_dump(powerOf(2,-3));
try
{
    var_dump(powerOf(0, 0));
}
catch(Exception $e)
{
    echo "Faljen Isus čeljadi\n";
}

try
{
    var_dump(powerOf(0, -5));
}
catch (Exception $e)
{
    echo "More li se\n";
}
