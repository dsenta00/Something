<?php

require_once('../../Library/TheString.php');
require_once('../../Library/UniqueLinkedList.php');

/**
 * Get substring list.
 *
 * Result of("Ante") -> { "A", "An", "Ant", "Ante", "n", "nt", "nte", "t", "te", "e"}.
 *
 * @param TheString $string
 * @return LinkedList
 */
function getAllSubstrings(TheString $string) : LinkedList
{
    $substringList = new LinkedList();
    $length = $string->length();

    for ($i = 0; $i < $length; $i++)
    {
        for ($substringLength = 1;
             $substringLength <= ($length - $i);
             $substringLength++)
        {
            $substringList->pushBack($string->getSubstring($i, $substringLength));
        }
    }

    return $substringList;
}

/**
 * Intersect two lists.
 *
 * @param LinkedList $list1 - first list.
 * @param LinkedList $list2 - second list.
 * @return LinkedList
 */
function intersect(LinkedList $list1,
                   LinkedList $list2) : LinkedList
{
    $list = new LinkedList();

    $list1->forRange(function ($data1) use ($list2, $list)
    {
        $list2->forRange(function ($data2) use ($data1, $list)
        {
           if ($data1 == $data2)
           {
               $list->pushBack($data1);
           }
        });
    });

    return $list;
}

/**
 * Get longest common substring.
 *
 * @param TheString $string1
 * @param TheString $string2
 * @return null|The
 */
function longestCommonSubstring(TheString $string1,
                                TheString $string2)
{
    $substringList1 = getAllSubstrings($string1);
    $substringList2 = getAllSubstrings($string2);
    $intersectList = intersect($substringList1, $substringList2);

    $intersectList->sort(function (TheString $string1, TheString $string2) {
        return $string1->length() > $string2->length();
    });

    return $intersectList->first();
}

var_dump(longestCommonSubstring(new TheString("Ana voli milovana"),
                                new TheString("kravana")));