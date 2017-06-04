<?php

require_once('TheString.php');
use PHPUnit\Framework\TestCase;

final class TheStringTest extends TestCase
{
    /**
     * Test TheString::length()
     */
    public function test_length() : void
    {
        $string = new TheString();
        $this->assertEquals(0, $string->length());

        $string = new TheString("");
        $this->assertEquals(0, $string->length());

        $string = new TheString("ana");
        $this->assertEquals(3, $string->length());

        $string = new TheString("anakakipuno");
        $this->assertEquals(11, $string->length());

        $string = new TheString("miljenko");
        $this->assertEquals(8, $string->length());

        $string = new TheString("Ana voli Milovana");
        $this->assertEquals(17, $string->length());

        $string = new TheString("A mene tu ni minute nema.");
        $this->assertEquals(25, $string->length());
    }

    /**
     * Test TheString::removeAll()
     */
    public function test_removeAll() : void
    {
        $string = new TheString("Otorinolaringologija.");

        $string->removeAll('a');
        $this->assertEquals("Otorinolringologij.", $string);
        $string->removeAll('a');
        $this->assertEquals("Otorinolringologij.", $string);

        $string->removeAll('o');
        $this->assertEquals("Otrinlringlgij.", $string);
        $string->removeAll('o');
        $this->assertEquals("Otrinlringlgij.", $string);

        $string->removeAll('r');
        $this->assertEquals("Otinlinglgij.", $string);
        $string->removeAll('r');
        $this->assertEquals("Otinlinglgij.", $string);

        $string->removeAll('l');
        $this->assertEquals("Otininggij.", $string);
        $string->removeAll('l');
        $this->assertEquals("Otininggij.", $string);

        $string->removeAll('g');
        $this->assertEquals("Otininij.", $string);
        $string->removeAll('g');
        $this->assertEquals("Otininij.", $string);

        $string->removeAll('.');
        $this->assertEquals("Otininij", $string);
        $string->removeAll('.');
        $this->assertEquals("Otininij", $string);

        $string->removeAll('i');
        $this->assertEquals("Otnnj", $string);
        $string->removeAll('i');
        $this->assertEquals("Otnnj", $string);

        $string->removeAll('O');
        $this->assertEquals("tnnj", $string);
        $string->removeAll('O');
        $this->assertEquals("tnnj", $string);

        $string->removeAll('n');
        $this->assertEquals("tj", $string);
        $string->removeAll('n');
        $this->assertEquals("tj", $string);

        $string->removeAll('t');
        $this->assertEquals("j", $string);
        $string->removeAll('t');
        $this->assertEquals("j", $string);

        $string->removeAll('j');
        $this->assertEquals("", $string);
        $string->removeAll('j');
        $this->assertEquals("", $string);
    }

    /**
     * Test TheString::removeNonAlphaNumeric()
     */
    public function test_removeNonAlphaNumeric() : void
    {
        $string = new TheString();
        $string->removeNonAlphaNumeric();
        $this->assertEquals("", $string);

        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $string->removeNonAlphaNumeric();
        $this->assertEquals('OtorinolaringologijaKlasikT1igreLafeAsuuuu', $string);
    }

    /**
     * Test TheString::toLower()
     */
    public function test_toLower() : void
    {
        $string = new TheString();
        $string->toLower();
        $this->assertEquals("", $string);

        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $string->toLower();
        $this->assertEquals("otorinolaringologija. klasik_t1igre.! lafe ... asuuuu!", $string);
    }

    /**
     * Test TheString::reverse()s
     */
    public function test_reverse()
    {
        $string = new TheString();
        $string->reverse();
        $this->assertEquals("", $string);

        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $string->reverse();
        $this->assertEquals("!uuuusA ... efaL !.ergi1T_kisalK .ajigologniralonirotO", $string);
    }

    /**
     * Test TheString::getSubstring()
     */
    public function test_getSubstring()
    {
        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $this->assertEquals("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!", $string->getSubstring());
        $this->assertEquals("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!", $string->getSubstring(0));
        $this->assertEquals("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!", $string->getSubstring(0, $string->length()));

        try
        {
            $string->getSubstring(-1, 43);
        }
        catch (Exception $e)
        {
            $this->assertEquals("position is negative -> -1", $e->getMessage());
        }

        try
        {
            $string->getSubstring($string->length(), 43);
        }
        catch (Exception $e)
        {
            $this->assertEquals("position out of range for string -> " . "\"" . $string . "\" [" . $string->length() . "]",
                $e->getMessage());
        }

        $this->assertEquals("O", $string->getSubstring(0, 1));
        $this->assertEquals("Otorinolaringologija", $string->getSubstring(0, 20));
        $this->assertEquals("Klasik", $string->getSubstring(22, 6));
        $this->assertEquals("Klasik_T1igre.! Lafe ... Asuuuu!", $string->getSubstring(22));
    }

    /**
     * Test TheString::compare()
     */
    public function test_compare() : void
    {
        $string = new TheString();
        $this->assertEquals(0, $string->compare(new TheString()));
        $this->assertEquals(0, $string->compare(new TheString("")));
        $this->assertNotEquals(0, $string->compare(new TheString("konjo")));

        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $this->assertEquals(0, $string->compare(new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!")));
        $this->assertNotEquals(0, $string->compare(new TheString("Oto")));
        $this->assertEquals(0, $string->compare(new TheString("Oto"), 0, 3));

        $string = new TheString("anakakipuno");
        $this->assertNotEquals(0, $string->compare(new TheString("onupikakana")));
        $this->assertNotEquals(0, $string->compare(new TheString()));
    }

    /**
     * Test TheString::equals()
     */
    public function test_equals() : void
    {
        $string = new TheString();
        $this->assertTrue($string->equals(new TheString()));
        $this->assertTrue($string->equals(new TheString("")));
        $this->assertFalse($string->equals(new TheString("konjo")));

        $string = new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!");
        $this->assertTrue($string->equals(new TheString("Otorinolaringologija. Klasik_T1igre.! Lafe ... Asuuuu!")));
        $this->assertFalse($string->equals(new TheString("Oto")));

        $string = new TheString("anakakipuno");
        $this->assertFalse($string->equals(new TheString("AnaKakiPuno")));
        $this->assertFalse($string->equals(new TheString("onupikakana")));
        $this->assertFalse($string->equals(new TheString()));
    }

    /**
     * Test TheString::isPalindrome()
     */
    public function test_isPalindrome() : void
    {
        $string = new TheString();
        $this->assertEquals(true, $string->isPalindrome());

        $string = new TheString("");
        $this->assertEquals(true, $string->isPalindrome());

        $string = new TheString("ana");
        $this->assertEquals(true, $string->isPalindrome());

        $string = new TheString("anakakipuno");
        $this->assertEquals(false, $string->isPalindrome());

        $string = new TheString("miljenko");
        $this->assertEquals(false, $string->isPalindrome());

        $string = new TheString("Ana voli Milovana");
        $this->assertEquals(true, $string->isPalindrome());

        $string = new TheString("A mene tu ni minute nema.");
        $this->assertEquals(true, $string->isPalindrome());
    }
}
