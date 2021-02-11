<?php

use Schalkt\Faker\Faker;

require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker::init();

$words = [];
$words[] = $faker->word(2);
$words[] = $faker->word(3);
$words[] = $faker->word(5);
$words[] = $faker->word(7, Faker::FIRST_VOWEL);
$words[] = $faker->word(14);
$words[] = $faker->words(20, ', ');
$words[] = $faker->sentence(20);
$words[] = $faker->text(20, 3, 7);

print_r($words);

$firstnames = [];
$firstnames[] = $faker->firstname();
$firstnames[] = $faker->firstname(3);
$firstnames[] = $faker->firstname(5);
$firstnames[] = $faker->firstname(7, Faker::FIRST_VOWEL);
$firstnames[] = $faker->firstname(14);

print_r($firstnames);

$fullnames = [];
$fullnames[] = $faker->fullname();
$fullnames[] = $faker->fullname(4, 7);
$fullnames[] = $faker->fullname(5, 10);
$fullnames[] = $faker->fullname(7, 7, true);
$fullnames[] = $faker->fullname(6, 8);
$fullnames[] = $faker->fullname(3, 3);
$fullnames[] = $faker->fullname(4, 2);

print_r($fullnames);

$codes = [];
$codes[] = $faker->mask();
$codes[] = $faker->mask('####-####-####-####', 'ABCD');
$codes[] = $faker->mask('##.##.##.##.##.##', 'dilemma');

print_r($codes);

$numbers = [];
$numbers[] = $faker->int(1);
$numbers[] = $faker->int(1000000, 9000000);
$numbers[] = $faker->mask('###-###-###-#-#-#', '01');
$numbers[] = $faker->boolean() ? 'true' : 'false';

print_r($numbers);

$faker = Faker::init([
	'vowels' => 'iea',
	'consonants' => 'dlm',
	'nextChar' => [
		'sameChar' => 0.0, // percent between 0-1
		'sameType' => 0.0, // percent between 0-1
		'double' => 0.5, // percent between 0-1
	]
]);

$words = [];
$words[] = $faker->word(2);
$words[] = $faker->word(3);
$words[] = $faker->word(5);
$words[] = $faker->word(7, Faker::FIRST_VOWEL);
$words[] = $faker->word(14);
$words[] = $faker->words(20, ', ');
$words[] = $faker->sentence(7);

print_r($words);


$faker = Faker::init([
	'vowels' => 'aeiou',
	'consonants' => 'bcdfghjklmnprstvz',
	'nextChar' => [
		'sameChar' => 0.0, // percent between 0-1
		'sameType' => 0.0, // percent between 0-1
		'double' => 0.0 // percent between 0-1
	],
]);

$names = [];
$names[] = $faker->words(14, ', ', 3, 3, Faker::FIRST_CONSONANT, ['izi', 'isi', 'iti', 'ini']);

print_r($names);


$faker = Faker::init([
	'vowels' => 'aeiou',
	'consonants' => 'bcdfghjklmnprstvz',
	'nextChar' => [
		'sameChar' => 0.0, // percent between 0-1
		'sameType' => 0.0, // percent between 0-1
		'double' => 0.0 // percent between 0-1
	],
]);

$names = [];
$names[] = $faker->words(14, ' ', 4, 4, Faker::FIRST_CONSONANT, ['zy', 'sy']);

print_r($names);


$faker = Faker::init([
	'vowels' => 'e',
	'consonants' => 'bcdfghjklmnprstvz',
	'nextChar' => [
		'sameChar' => 0.0, // percent between 0-1
		'sameType' => 0.0, // percent between 0-1
		'double' => 0.0 // percent between 0-1
	],
]);

$sentence = [];
$sentence[] = $faker->sentence(7);
$sentence[] = $faker->sentence(10);

print_r($sentence);


$faker = Faker::init([
	'vowels' => 'io',
	'consonants' => 'bd',
	'nextChar' => [
		'sameChar' => 0.0, // percent between 0-1
		'sameType' => 0.0, // percent between 0-1
		'double' => 0.0 // percent between 0-1
	],
]);

$words = [];
$words[] = strtoupper($faker->words(14, '.', 2, 4));

print_r($words);
