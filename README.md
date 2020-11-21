# Simple and easy faker for PHP

> The project is under development, but this is a working and stable version.

## Install

- SOON (`composer require schalkt\faker`)

## Examples

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
