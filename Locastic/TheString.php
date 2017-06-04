<?php

/**
 * The String.
 */
class TheString
{
    /**
     * @var string - Actual string. Default value is empty string.
     */
    private $string;

    /**
     * TheString constructor.
     *
     * @param $string - The string.
     */
    function __construct(string $string = null)
    {
        $this->string = ($string) ? $string : "";
    }

    /**
     * Check if character is capital letter.
     *
     * @param $char - The character.
     * @return bool - true if capital letter, otherwise return false
     */
    private function isCapitalLetter($char) : bool
    {
        $asciiValue = ord($char);
        return ($asciiValue >= 65) && ($asciiValue <= 90);
    }

    /**
     * Check if character is non capital letter.
     *
     * @param $char - The character.
     * @return bool - true if non capital letter, otherwise return false
     */
    private function isNonCapitalLetter($char)  : bool
    {
        $asciiValue = ord($char);
        return ($asciiValue >= 97) && ($asciiValue <= 122);
    }

    /**
     * Check if character is alpha.
     *
     * @param $char - The character.
     * @return bool - true if is alpha, otherwise return false.
     */
    private function isAlpha($char) : bool
    {
        return $this->isCapitalLetter($char) || $this->isNonCapitalLetter($char);
    }

    /**
     * Check if character is alpha.
     *
     * @param $char - The character.
     * @return bool - true if is alpha, otherwise return false.
     */
    private function isNumeric($char) : bool
    {
        $asciiValue = ord($char);
        return ($asciiValue >= 48) && ($asciiValue <= 57);
    }

    /**
     * Check if U8 character is alpha-numeric.
     *
     * @param $char - The character.
     * @return bool - true if is alpha-numeric, otherwise return false.
     */
    private function isAlphaNumeric($char) : bool
    {
        return $this->isAlpha($char) || $this->isNumeric($char);
    }

    /**
     * Get string length.
     *
     * @return int - string length.
     */
    public function length() : int
    {
        $length = 0;
        while ($this->string[$length])
        {
            $length++;
        }
        return $length;
    }

    /**
     * Remove all specific characters.
     *
     * @param $char - character to remove.
     */
    public function removeAll($char) : void
    {
        $string = "";

        for ($i = 0; $this->string[$i]; $i++)
        {
            if ($this->string[$i] !== $char)
            {
                $string .= $this->string[$i];
            }
        }

        $this->string = $string;
    }


    /**
     * Remove all non alpha-numeric characters from string.
     */
    public function removeNonAlphaNumeric() : void
    {
        for ($i = 0; $i < $this->length(); $i++)
        {
            if (!$this->isAlphaNumeric($this->string[$i]))
            {
                $this->removeAll($this->string[$i]);
            }
        }
    }

    /**
     * Put all characters to lower case.
     */
    public function toLower() : void
    {
        for ($i = 0; $this->string[$i]; $i++)
        {
            if ($this->isCapitalLetter($this->string[$i]))
            {
                $this->string[$i] = chr(ord($this->string[$i]) + 32);
            }
        }
    }

    /**
     * Reverse string.
     */
    public function reverse() : void
    {
        $length = $this->length();

        if ($length < 2)
        {
            return;
        }

        for ($i = 0; $i < $length / 2; $i++)
        {
            $tmp = $this->string[$i];
            $this->string[$i] = $this->string[$length - ($i + 1)];
            $this->string[$length - ($i + 1)] = $tmp;
        }
    }

    /**
     * Get substring.
     *
     * @param int $position - position (optional parameter)
     * @param int $length - length (optional parameter)
     * @return TheString.
     * @throws Exception - if position is out of range.
     */
    public function getSubstring($position = 0, $length = 0) : TheString
    {
        $substring = "";

        /*
         * Check position boundaries according to both strings.
         */
        if ($position < 0)
        {
            throw new Exception("position is negative -> " . $position);
        }
        else if (($position >= $this->length()) && ($position != 0))
        {
            throw new Exception("position out of range for string -> " .
                "\"" . $this->string . "\" [" . $position . "]");
        }

        if ($length == 0)
        {
            $length = $this->length();
        }

        for ($i = $position; ($length > 0) && $this->string[$i]; $i++)
        {
            $substring[$i - $position] = $this->string[$i];
            $length--;
        }

        return new TheString($substring);
    }

    /**
     * Compare with another string.
     *
     * @param TheString $anotherTheString - another TheString.
     * @param int $position - position index start of this string (optional)
     * @param int $length - length to compare. (optional)
     * @return int|null - < 0 the first character that does not match has a lower value in this string than in another string.
     *                  -   0 the contents of both strings are equal.
     *                  - > 0 the first character that does not match has a greater value in this string than in another string.
     * @throws Exception - Unexpected exception happens if:
     *                       - position is out of range for one of both strings
     *                       - length is negative
     *                       - position is negative
     */
    public function compare(TheString $anotherTheString,
                            $position = 0,
                            $length = 0) : int
    {
        if ($length == 0)
        {
            $length = $this->length();
        }

        $substring = $this->getSubstring($position, $length);

        /*
         * Compare strings with different length i.e. "ana" and "anakonda"
         */
        $substringLength = $substring->length();
        $anotherTheStringLength = $anotherTheString->length();

        if ($substringLength > $anotherTheStringLength)
        {
            return ($anotherTheStringLength > 0) ?
                ord($substring->string[$substringLength - $anotherTheStringLength]) :
                ord($substring->string[0]);
        }
        else if ($substringLength < $anotherTheStringLength)
        {
            return ($substringLength > 0) ?
                ord($anotherTheString->string[$anotherTheStringLength - $substringLength]) :
                ord($anotherTheString->string[0]);
        }

        /*
         * Lengths are the same, compare every index matched char from both strings.
         */
        for ($i = 0;
             ($length > 0) && $substring->string[$i] && $anotherTheString->string[$i];
             $i++)
        {
            $diff = ord($substring->string[$i]) - ord($anotherTheString->string[$i]);

            if ($diff != 0)
            {
                return $diff;
            }

            $length--;
        }

        return 0;
    }

    /**
     * Check if two strings are equal.
     *
     * @param TheString $anotherTheString - The another string.
     * @return bool - true if equals, otherwise return false.
     */
    public function equals(TheString $anotherTheString) : bool
    {
        return $this->compare($anotherTheString) == 0;
    }

    /**
     * Check if string is palindrome.
     *
     * @return bool - true if palindrome, otherwise return false.
     */
    public function isPalindrome() : bool
    {
        $lowerString = new TheString($this->string);
        $lowerString->removeNonAlphaNumeric();
        $lowerString->toLower();

        $lowerStringReverse = new TheString($this->string);
        $lowerStringReverse->removeNonAlphaNumeric();
        $lowerStringReverse->toLower();
        $lowerStringReverse->reverse();

        return $lowerString->equals($lowerStringReverse);
    }

    /**
     * To string.
     */
    public function __toString()
    {
        return $this->string;
    }
};