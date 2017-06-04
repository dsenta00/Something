<?php

function lowestNumber(array $dataArray) : ?double
{
    $result = null;

    foreach ($dataArray as $data)
    {
        switch (gettype($data))
        {
            case "boolean":
            case "object":
            case "resource":
            case "NULL":
            case "unknown type":
                /* Skip those kind of variables */
                break;
            case "integer":
            case "double":
                if (!$result || ($result > $data))
                {
                    $result = $data;
                }
                break;
            case "string":

                break;
            case "array":
                break;
        }
    }

    return $result;
}