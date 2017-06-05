<?php

require_once ('LinkedList.php');

function arrayToList(array $array) : LinkedList
{
    $list = new LinkedList();

    foreach ($array as $data)
    {
        $list->pushBack($data);
    }

    return $list;
}

function intListSum(LinkedList $list) : int
{
    $sum = 0;
    $list->forRange(function ($data) use (&$sum) {
        $sum += $data;
    });
    return $sum;
}

function groupNumbers(LinkedList $list, int $numGroups)
{
    if (($numGroups <= 0) or ($list->length() == 0))
    {
        return null;
    }

    $list->sort(function (int $var1, int $var2) {
        return $var1 > $var2;
    });

    $groups = new LinkedList();

    for ($i = 0; $i < $numGroups; $i++)
    {
        $groups->pushBack(new LinkedList());
    }

    $groupIndex = 0;
    $direction = true;
    $list->forRange(function ($data) use ($groups, &$groupIndex, &$direction, $numGroups) {
        $groups->get($groupIndex)->pushBack($data);

        if ($direction)
        {
            $groupIndex++;

            if ($groupIndex == $numGroups)
            {
                $groupIndex--;
                $direction = false;
            }
        }
        else
        {
            $groupIndex--;

            if ($groupIndex == -1)
            {
                $groupIndex++;
                $direction = true;
            }
        }
    });

    return $groups;
}

function printGroups(LinkedList $groups)
{
    $groups->forRange(function (LinkedList $group) {
        echo "[";
        $group->forRange(function ($var) {
            echo $var . " ";
        });
        echo "]\n";
    });
}

printGroups(
    groupNumbers(
        arrayToList(array(2, 1, 4, 7, 1, 2, 6, 8)), 3));