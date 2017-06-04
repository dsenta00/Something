<?php

require_once('TheString.php');
require_once('UniqueLinkedList.php');

/**
 * Get substring list.
 *
 * Result of("Ante") -> { "A", "An", "Ant", "Ante", "n", "nt", "nte", "t", "te", "e"}.
 *
 * @param TheString $string
 * @return UniqueLinkedList
 */
function getAllSubstrings(TheString $string) : UniqueLinkedList
{
    $substringList = new UniqueLinkedList();
    $length = $string->length();

    for ($i = 0; $i < $length; $i++)
    {
        for ($substringLength = 1;
             $substringLength <= ($length - $i);
             $substringLength++)
        {
            $substringList->add($string->getSubstring($i, $substringLength));
        }
    }

    return $substringList;
}

/**
 * Intersect two lists.
 *
 * @param UniqueLinkedList $list1 - first list.
 * @param UniqueLinkedList $list2 - second list.
 * @return UniqueLinkedList
 */
function intersect(UniqueLinkedList $list1,
                   UniqueLinkedList $list2) : UniqueLinkedList
{
    $list = new UniqueLinkedList();

    $list1->forRange(function ($data1) use ($list2, $list) {
        $list2->forRange(function ($data2) use ($data1, $list) {
           if ($data1 == $data2)
           {
               $list->pushBack($data1);
           }
        });
    });

    return $list;
}

function longestCommonSubstring(TheString $string1,
                                TheString $string2)
{
    $substringList1 = getAllSubstrings($string1);
    $substringList2 = getAllSubstrings($string2);
    $intersectList = intersect($substringList1, $substringList2);

    $intersectList->sort(function (TheString $string1, TheString $string2) {
        return $string1->compare($string2) < 0;
    });

    $intersectList->forRange(function (TheString $string) {
        echo $string . "<br>";
    });

    return $intersectList->first();
}

var_dump(longestCommonSubstring(new TheString("ananas"),
                                new TheString("ana")));