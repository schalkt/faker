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
    protected $abcLower = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected $abcUpper = 'abcdefghijklmnopqrstuvwxyz';
    protected $numbers = '0123456789';

    protected $vowelsDouble = ['ai', 'ue', 'oa', 'ou', 'oo', 'ee', 'ui', 'ea', 'oi'];
    protected $consonantsDouble = ['sh', 'th', 'ck', 'gh', 'wh', 'ch', 'ph'];
    // 'ty', 'cy',  'ry', 'sy', 'ly'

    protected $vowelsCount = 5;
    protected $consonantsCount = 21;

    protected $options = [
        'vowels' => '',
        'consonants' => '',
        'vowelsDouble' => '',
        'consonantsDouble' => '',
        'nextChar' => [
            'sameChar' => 2, // percent between 0-100
            'sameType' => 4, // percent between 0-100
            'double' => 1, // percent between 0-100
        ]
    ];

    /**
     * __construct
     *
     * @param  array $options
     * @return Faker
     */
    public function __construct(array $options = [])
    {

        $this->options = \array_replace_recursive($this->options, $options);

        if (!empty($options['vowels'])) {
            $this->vowels = trim($options['vowels']);
            $this->vowelsCount = mb_strlen($this->vowels);
        }

        if (!empty($options['consonants'])) {
            $this->consonants = trim($options['consonants']);
            $this->consonantsCount = mb_strlen($this->consonants);
        }

        if (!empty($options['vowelsDouble'])) {
            $this->vowelsDouble = $options['vowelsDouble'];
        }

        if (!empty($options['consonantsDouble'])) {
            $this->consonantsDouble = $options['consonantsDouble'];
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
    public function word($length = null, $first = null, $suffixes = [])
    {

        $firsts = [self::FIRST_VOWEL, self::FIRST_CONSONANT];

        $length = $length === null ? rand(3, 10) : $length;
        $first = $first === null ? $firsts[array_rand($firsts, 1)] : $first;

        $char1 = ($first === self::FIRST_CONSONANT) ? $this->getRandomConsonant() : $this->getRandomVowel();
        $word = [$char1];

        for ($i = 0; $i < $length - 1; $i++) {
            $word[] = $this->getRandomNextChar($word[$i]);
        }

        if (!empty($suffixes)) {
            $word[] = $suffixes[array_rand($suffixes, 1)];
        }

        return implode($word);
    }

    /**
     * words
     *
     * @param  mixed $count
     * @return void
     */
    public function words($count = 4, $glue = ' ', $min = 4, $max = 7, $first = null, $suffixes = [])
    {

        $words = [];

        for ($i = 0; $i < $count; $i++) {
            $words[] = $this->word(rand($min, $max), $first, $suffixes);
        }

        return implode($glue, $words);
    }


    /**
     * sentence
     *
     * @param  mixed $words
     * @return void
     */
    public function sentence($words = null)
    {

        $sentence = $this->words($words, ' ', 2, 14);
        return ucfirst($sentence) . '.';
    }


    /**
     * chars
     *
     * @param  mixed $chars
     * @param  mixed $min
     * @param  mixed $max
     * @param  mixed $segments
     * @param  mixed $glue
     * @return void
     */
    public function chars($chars = null, $min = 2, $max = 21, $segments = 1, $glue = '-')
    {

        $parts = [];
        $chars = $chars !== null ? $chars : \str_shuffle($this->vowels . $this->consonants);
        $count = strlen($chars);

        for ($s = 0; $s < $segments; $s++) {

            $part = '';
            $length = rand($min, $max);

            for ($i = 0; $i < $length; $i++) {
                $part .= $chars[rand(0, $count - 1)];
            }

            $parts[] = $part;
        }

        return implode($glue, $parts);
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
            return mb_substr($this->consonants, $position, 1);
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
            return mb_substr($this->vowels, $position, 1);
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

        $r1 = rand(1, 100);
        $r2 = rand(1, 100);
        $r3 = rand(1, 100);

        if ($this->options['nextChar']['sameChar'] > $r1) {
            $char = $prev;
        } else if ($this->options['nextChar']['sameType'] > $r2) {
            $char = $this->isVowel($prev) ? $this->getRandomVowel() : $this->getRandomConsonant();
        } else if ($this->options['nextChar']['double'] > $r3) {
            $char = $this->isVowel($prev) ? $this->getRandomVowel(true) : $this->getRandomConsonant(true);
        } else {
            $char = $this->isVowel($prev) ? $this->getRandomConsonant() : $this->getRandomVowel();
        }

        return $char;
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
    public function firstname($min = 5, $max = 7, $first = null, $suffixes = [])
    {

        $firstname = $this->word(rand($min, $max), $first, $suffixes);
        return ucfirst($firstname);
    }

    /**
     * lastname
     *
     * @param  mixed $length
     * @param  mixed $first
     * @return void
     */
    public function lastname($min = 5, $max = 7, $first = null, $suffixes = [])
    {

        $lastname = $this->word(rand($min, $max), $first, $suffixes);
        return ucfirst($lastname);
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

        $max = mb_strlen($input) - 1;
        $chars = mb_str_split($mask);
        $output = [];



        foreach ($chars as $char) {
            $output[] = $char === '#' ? $input[rand(0, $max)] : $char;
        }

        return implode('', $output);
    }


    /**
     * email
     *
     * @return void
     */
    public function email()
    {

        return strtolower($this->words(2, '.', 3, 12)) . '@' . $this->word() . '.' . $this->words(1, '', 2, 5);
    }


    /**
     * password
     *
     * @return void
     */
    public function password($min = 8, $max = 16, $segments = 2, $glue = '-')
    {

        $chars = $this->abcLower . $this->abcUpper . $this->numbers;
        return $this->chars($chars, $min, $max, $segments, $glue);
    }
}
