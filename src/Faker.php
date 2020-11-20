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

    protected $vowelsCount = 5;
    protected $consonantsCount = 21;

    protected $options = [
        'nextChar' => [
            'sameChar' => 0.07, // percent 0-1
            'sameType' => 0.14, // percent 0-1
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
        //$this->options = \array_replace_recursive((array)$this->$options, (array)$options);    
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
    public function word($length = 2, $first = self::FIRST_CONSONANT)
    {

        $char1 = ($first === self::FIRST_CONSONANT) ? $this->getRandomConsonant() : $this->getRandomVowel();
        $word = [$char1];

        for ($i = 0; $i < $length - 1; $i++) {
            $word[] = $this->getRandomNextChar($word[$i]);
        }

        return implode($word);
    }


    /**
     * getRandomConsonant
     *
     * @return void
     */
    protected function getRandomConsonant()
    {

        $position = rand(0, $this->consonantsCount - 1);
        return $this->consonants[$position];
    }

    /**
     * getRandomVowel
     *
     * @return void
     */
    protected function getRandomVowel()
    {

        $position = rand(0, $this->vowelsCount - 1);
        return $this->vowels[$position];
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
            $output[] = $char === '#' ? $input[rand(1, $max)] : $char;
        }

        return implode('', $output);
    }



    /**
     * intmask
     *
     * @param  mixed $mask
     * @param  mixed $min
     * @param  mixed $max
     * @return void
     */
    public function intmask($mask = '###', $min = 0, $max = 9)
    {

        $chars = \str_split($mask);
        $output = [];

        foreach ($chars as $char) {
            $output[] = $char === '#' ? rand($min, $max) : $char;
        }

        return implode('', $output);
    }
}
