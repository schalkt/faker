# Simple and easy faker for PHP

> The project is under development, but this is a working and stable version.

- randomly generated words from vowels and consonants
- customizeble vowels and consonants
  - fake Esperanto (Evevete etet sek edeleme)
  - pattern look (DIBI.BOB.BO.DID.IBI.IBID.BID)
- word suffix for funny names (mikozy nadusy hetezy jukesy)

## Install

- SOON (`composer require schalkt\faker`)

## Examples

- `composer run demo`
- `php ./examples/demo1.php`

```php

    require_once '/vendor/autoload.php';

    use Schalkt\Faker\Faker;

    $faker = Faker::init();
    $faker->firstname(7, Faker::FIRST_VOWEL);
    $faker->fullname(5, 10);
    $faker->word(5);
    $faker->words(20, ', ');
    $faker->sentence(20);
    $faker->text(20, 3, 7);
    $faker->mask('###-###-###-###', 'ABCDEFG');
    $faker->mask('##-##-##-##', '01');
    $faker->int(1,100);
    $faker->boolean();


```

## Todo

- password(length)
- email()
- array($count, $items)
- date($format, $max, $min)
- float($decimals, $min, $max)