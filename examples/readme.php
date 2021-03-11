<?php

use Schalkt\Faker\Faker;

require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker::init();

$items = [];

$items[] = $faker->fullname(5, 10);
$items[] = $faker->firstname(7, 7, Faker::FIRST_VOWEL);
$items[] = $faker->word(5);
$items[] = $faker->words(5, ', ');
$items[] = $faker->sentence(5);
$items[] = $faker->text(3, 3, 3);
$items[] = $faker->mask('###-###-###-###', 'ABCDEFG');
$items[] = $faker->mask('##-##-##-##', '01');
$items[] = $faker->int(1,1000); // 256 
$items[] = $faker->boolean(); // true or false
$items[] = $faker->chars('.', 4, 4, 3, 'oOo'); // ....oOo....oOo....
$items[] = $faker->password(4, 4, 3, '.'); // W2gg.lsgq.FET0
$items[] = $faker->chars('#', 3, 3, 4, '-');

print_r($items);