<?php

require_once('../../Library/LinkedList.php');

/**
 * Convert array to linked list.
 *
 * @param array $array
 * @return LinkedList
 */
function arrayToList(array $array) : LinkedList
{
    $list = new LinkedList();

    foreach ($array as $data)
    {
        $list->pushBack($data);
    }

    return $list;
}

/**
 * Group numbers.
 *
 * @param LinkedList $list - integer list.
 * @param int $numGroups - number of groups.
 * @return LinkedList|null - groups.
 */
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

/**
 * Print groups.
 * @param LinkedList $groups
 */
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