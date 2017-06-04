<?php

function powerOf(int $n, int $m) : float
{
    if (($n == 0) && ($m < 1))
    {
        /* throw new Exception("Undefined -> 0^" . $m); */
        echo "Undefined -> 0^" . $m;
        return 0.0;
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
var_dump(powerOf(0,0));
var_dump(powerOf(0,-5));
