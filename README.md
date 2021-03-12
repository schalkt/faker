# Simple and easy random faker for PHP

> The project is under development, but this is a working and stable version.

[![GitHub issues](https://img.shields.io/github/issues/schalkt/faker.svg?style=flat-square)](https://github.com/schalkt/faker/issues)
[![Build Status](https://travis-ci.org/schalkt/faker.svg?branch=master)](https://travis-ci.org/schalkt/faker)

- randomly generated words from vowels and consonants
- customizeble vowels and consonants
  - fake Esperanto (Evevete etet sek edeleme)
  - pattern look (DIBI.BOB.BO.DID.IBI.IBID.BID)
- word suffix for funny names (mikozy nadusy hetezy jukesy)

## Install

- SOON (`composer require schalkt\faker`)

## Examples

- `composer run demo`
- `php ./examples/demo.php`

```php

    require_once '/vendor/autoload.php';

    use Schalkt\Faker\Faker;

    $faker = Faker::init();

    $faker->fullname(5, 10); // Sutida Ohisovis
    $faker->firstname(7, 7, Faker::FIRST_VOWEL); // Emubefy
    $faker->email(); // punuw.honiw@ajesug.gax
    $faker->password(4, 4, 3, '.'); // W2gg.lsgq.FET0
    $faker->word(5); // focix
    $faker->words(5, ', '); // rabija, yigav, bacera, cunay, okzupu
    $faker->sentence(5); // Uxibawoz witowarehep effemerogola buinaxepugo nuxehow.
    $faker->text(3, 3, 3); // Icolivotuse rebotuk sulageye. Xaco najud quq.
    $faker->int(1,1000); // 256 
    $faker->boolean(); // true or false    
    $faker->chars('.', 4, 4, 3, 'oOo'); // ....oOo....oOo....    
    $faker->chars('#', 3, 3, 4, '-'); // ###-###-###-###
    $faker->mask('###-###-###-###', 'ABCDEFG'); // AAE-BAF-DDB-AAF
    $faker->mask('##-##-##-##', '01'); // 11-10-01-10

```

### Fake esperente

```php

    require_once '/vendor/autoload.php';

    use Schalkt\Faker\Faker;

    $faker = Faker::init([
      'vowels' => 'e',
      'consonants' => 'bhdlmnkpstvz',
      'nextChar' => [
        'sameChar' => 0, // percent between 0-100
        'sameType' => 0, // percent between 0-100
        'double' => 0 // percent between 0-100
      ],
    ]);

    $items[] = $faker->sentence(5); // Sedev emeze evekem ez denebebekepep.

```

## Todo

- array($count, $items)
- date($format, $max, $min)
- float($decimals, $min, $max)
