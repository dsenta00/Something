<?php

require_once('../../Library/TheString.php');

$theString = new TheString("miljenko");
var_dump($theString->isPalindrome());

$theString = new TheString("Ana voli Milovana");
var_dump($theString->isPalindrome());

$theString = new TheString("A mene tu ni minute nema.");
var_dump($theString->isPalindrome());