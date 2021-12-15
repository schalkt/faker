<?php

use Schalkt\Faker\Faker;

require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker::init();

$items = [];

$items[] = $faker->fullname(5, 10);
$items[] = $faker->firstname(7, 7, Faker::FIRST_VOWEL);
$items[] = $faker->email(); // punuw.honiw@ajesug.gax
$items[] = $faker->password(4, 4, 3, '.'); // W2gg.lsgq.FET0
$items[] = $faker->word(5);
$items[] = $faker->words(5, ', ');
$items[] = $faker->sentence(5);
$items[] = $faker->text(3, 3, 3);
$items[] = $faker->int(1,1000); // 256 
$items[] = $faker->boolean(); // true or false
$items[] = $faker->repeat('.', 4, 4, 3, 'oOo'); // ....oOo....oOo....
$items[] = $faker->repeat('#', 3, 3, 4, '-'); // ###-###-###-###
$items[] = $faker->repeat('124', 1, 5, 4, ' + '); // 2144 + 24444 + 444 + 22141
$items[] = $faker->mask('###-###-###-###', 'ABCDEFG');
$items[] = $faker->mask('##-##-##-##', '01');

$faker = Faker::init([
	'vowels' => 'e',
	'consonants' => 'bhdlmnkpstvz',
	'nextChar' => [
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 0 // percent between 0-100
	],
]);

$items[] = $faker->sentence(5); // Sedev emeze evekem ez denebebekepep

print_r($items);
