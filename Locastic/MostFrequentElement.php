<?php

require_once('UniqueLinkedList.php');

/**
 * Get most frequent element in array.
 *
 * @param array $dataArray - array.
 * @return mixed - most frequent element if exists, otherwise return null.
 */
function getMostFrequentData(array $dataArray)
{
    $uniqueList = new UniqueLinkedList();

    foreach ($dataArray as $data)
    {
        $uniqueList->add($data);
    }

    return $uniqueList->getMostFrequentData();
}

echo "First array: ";
var_dump(getMostFrequentData(array("Konj", "Konj", 5, "Konj", 1.0, 1, "Mico konan")));
echo "Second array: ";
var_dump(getMostFrequentData(array()));
echo "Third array: ";
var_dump(getMostFrequentData(array("konj", 5, "Konj", 1.0, 1, "Mico konan", null)));
