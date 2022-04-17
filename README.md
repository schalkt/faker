# Random data generator for PHP

[![GitHub issues](https://img.shields.io/github/issues/schalkt/faker.svg?style=flat-square)](https://github.com/schalkt/faker/issues)
[![Build Status](https://travis-ci.org/schalkt/faker.svg?branch=main)](https://travis-ci.org/schalkt/faker)

[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=schalkt_faker&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=schalkt_faker)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=schalkt_faker&metric=security_rating)](https://sonarcloud.io/dashboard?id=schalkt_faker)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=schalkt_faker&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=schalkt_faker)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=schalkt_faker&metric=bugs)](https://sonarcloud.io/dashboard?id=schalkt_faker)

- randomly generated characters, words, sentences
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
    $faker->words(2, ' | ', 4, 4, Faker::FIRST_CONSONANT, ['zy', 'sy']); // dodosy | rivozy
    $faker->sentence(5); // Uxibawoz witowarehep effemerogola buinaxepugo nuxehow.
    $faker->text(3, 3, 3); // Icolivotuse rebotuk sulageye. Xaco najud quq.
    $faker->int(1, 1000); // 238
    $faker->float(100, 200, 4); // 175.3874
    $faker->boolean(); // true or false    
    $faker->repeat('.', 4, 4, 3, 'oOo'); // ....oOo....oOo....    
    $faker->repeat('#', 3, 3, 4, '-'); // ###-###-###-###
    $faker->repeat('124', 1, 5, 4, ' + '); // 2144 + 24444 + 444 + 22141
    $faker->mask('###-###-###-###', 'ABCDEFG'); // AAE-BAF-DDB-AAF
    $faker->mask('##-##-##-##', '01'); // 11-10-01-10
    $faker->pick(['CEO', 'CTO', 'Founder', 'Director'], 3, ', '); // Director, CEO, CTO
    $faker->date('1970-01-01', '2010-12-31', 'Y-m'); // 2001-02

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

- $faker->fill($user)
- $faker->array($count, $items)

