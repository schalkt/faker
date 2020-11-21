<?php

namespace Schalkt\Faker;


/**
 * Simple and easy faker system for PHP
 */
class Faker
{

    const FIRST_VOWEL = 0;
    const FIRST_CONSONANT = 1;

    protected $vowels = 'aeiou';
    protected $consonants = 'bcdfghjklmnpqrstvwxyz';

    protected $vowelsDouble = ['ai', 'ue', 'oa', 'ou', 'oo', 'ee', 'ui', 'ea', 'oi'];
    protected $consonantsDouble = ['sh', 'th', 'ck', 'gh', 'wh', 'ch', 'ph'];
    // 'ty', 'cy',  'ry', 'sy', 'ly'

    protected $vowelsCount = 5;
    protected $consonantsCount = 21;

    protected $options = [
        'vowels' => '',
        'consonants' => '',
        'nextChar' => [
            'sameChar' => 0.02, // percent between 0-1
            'sameType' => 0.04, // percent between 0-1
            'double' => 0.01, // percent between 0-1
        ]
    ];

    /**
     * __construct
     *
     * @param  array $options
     * @return Faker
     */
    public function __construct(array $options)
    {

        $this->options = \array_replace_recursive($this->options, $options);

        if (!empty($options['vowels'])) {
            $this->vowels = trim($options['vowels']);
            $this->vowelsCount = strlen($this->vowels);
        }

        if (!empty($options['consonants'])) {
            $this->consonants = trim($options['consonants']);
            $this->consonantsCount = strlen($this->consonants);
        }
    }

    /**
     * init
     *
     * @param  array $options
     * @return Faker
     */
    public static function init(array $options = [])
    {
        return new self($options);
    }


    /**
     * word
     *
     * @param  mixed $length
     * @param  mixed $first
     * @return void
     */
    public function word($length = null, $first = null)
    {

        $length = $length === null ? rand(3, 10) : $length;
        $first = $first === null ? array_rand([self::FIRST_VOWEL, self::FIRST_CONSONANT]) : $first;

        $char1 = ($first === self::FIRST_CONSONANT) ? $this->getRandomConsonant() : $this->getRandomVowel();
        $word = [$char1];

        for ($i = 0; $i < $length - 1; $i++) {
            $word[] = $this->getRandomNextChar($word[$i]);
        }

        return implode($word);
    }

    /**
     * words
     *
     * @param  mixed $count
     * @return void
     */
    public function words($count = 4, $glue = ' ', $min = 4, $max = 7)
    {

        $words = [];

        for ($i = 0; $i < $count; $i++) {
            $words[] = $this->word(rand($min, $max));
        }

        return implode($glue, $words);
    }


    /**
     * sentence
     *
     * @param  mixed $length
     * @return void
     */
    public function sentence($length = null)
    {

        $sentence = $this->words($length, ' ', 2, 14);
        return ucfirst($sentence) . '.';
    }


    /**
     * text
     *
     * @param  int $sentences
     * @return void
     */
    public function text($sentences = 5, $min = 4, $max = 7)
    {

        $text = [];

        for ($i = 0; $i < $sentences - 1; $i++) {
            $text[] = $this->sentence(rand($min, $max));
        }

        return implode(' ', $text);
    }



    /**
     * getRandomConsonant
     *
     * @param  mixed $double
     * @return void
     */
    protected function getRandomConsonant($double = false)
    {

        if ($double) {
            $position = rand(0, count($this->consonantsDouble) - 1);
            return $this->consonantsDouble[$position];
        } else {
            $position = rand(0, $this->consonantsCount - 1);
            return $this->consonants[$position];
        }
    }


    /**
     * getRandomVowel
     *
     * @param  mixed $double
     * @return void
     */
    protected function getRandomVowel($double = false)
    {

        if ($double) {
            $position = rand(0, count($this->vowelsDouble) - 1);
            return $this->vowelsDouble[$position];
        } else {
            $position = rand(0, $this->vowelsCount - 1);
            return $this->vowels[$position];
        }
    }


    /**
     * getRandomNextChar
     *
     * @param  mixed $prev
     * @return void
     */
    protected function getRandomNextChar($prev)
    {

        $r1 = rand(1, 100) / 100;

        if ($this->options['nextChar']['sameChar'] > $r1) {
            return $prev;
        }

        $r2 = rand(1, 100) / 100;

        if ($this->options['nextChar']['sameType'] > $r2) {
            return $this->isVowel($prev) ? $this->getRandomVowel() : $this->getRandomConsonant();
        }

        $r3 = rand(1, 100) / 100;

        if ($this->options['nextChar']['double'] > $r3) {
            return $this->isVowel($prev) ? $this->getRandomVowel(true) : $this->getRandomConsonant(true);
        }

        return $this->isVowel($prev) ? $this->getRandomConsonant() : $this->getRandomVowel();
    }

    /**
     * isVowel
     *
     * @param  mixed $char
     * @return void
     */
    protected function isVowel($char)
    {
        return strpos($this->vowels, $char) !== false ? true : false;
    }


    /**
     * firstname
     *
     * @param  mixed $length
     * @param  mixed $first
     * @return void
     */
    public function firstname($length = null, $first = self::FIRST_CONSONANT)
    {

        $length = $length === null ? rand(2, 7) : $length;

        $char1 = ($first === self::FIRST_CONSONANT) ? $this->getRandomConsonant() : $this->getRandomVowel();
        $word = [$char1];

        for ($i = 0; $i < $length - 1; $i++) {
            $word[] = $this->getRandomNextChar($word[$i]);
        }

        return ucfirst(implode($word));
    }

    /**
     * lastname
     *
     * @param  mixed $length
     * @param  mixed $first
     * @return void
     */
    public function lastname($length = null, $first = self::FIRST_CONSONANT)
    {

        $length = $length === null ? rand(3, 11) : $length;

        $char1 = ($first === self::FIRST_CONSONANT) ? $this->getRandomConsonant() : $this->getRandomVowel();
        $word = [$char1];

        for ($i = 0; $i < $length - 1; $i++) {
            $word[] = $this->getRandomNextChar($word[$i]);
        }

        return ucfirst(implode($word));
    }


    /**
     * fullname
     *
     * @param  mixed $lengthFirst
     * @param  mixed $lengthLast
     * @param  mixed $reverse
     * @return void
     */
    public function fullname($lengthFirst = null, $lengthLast = null, $reverse = false)
    {

        return $reverse ? implode(' ', [
            $this->lastname($lengthLast),
            $this->firstname($lengthFirst)
        ]) : implode(' ', [
            $this->firstname($lengthFirst),
            $this->lastname($lengthLast)
        ]);
    }


    /**
     * int
     *
     * @param  mixed $min
     * @param  mixed $max
     * @return void
     */
    public function int($min = 0, $max = 10000)
    {
        return rand($min, $max);
    }

    /**
     * boolean
     *
     * @param  mixed $min
     * @param  mixed $max
     * @return void
     */
    public function boolean()
    {
        return (bool)rand(0, 1);
    }


    /**
     * mask
     *
     * @param  mixed $mask
     * @param  mixed $input
     * @return void
     */
    public function mask($mask = '###-###-###', $input = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789')
    {

        $max = strlen($input) - 1;
        $chars = \str_split($mask);
        $output = [];



        foreach ($chars as $char) {
            $output[] = $char === '#' ? $input[rand(0, $max)] : $char;
        }

        return implode('', $output);
    }
}
