<?php

for ($i = 0; $i < 100; $i++)
{
    if ($i % 3 == 0)
    {
        echo "LOCA";
    }

    if ($i % 5 == 0)
    {
        echo "STIC";
    }


    echo "(" . $i . ")" . "\n";
}