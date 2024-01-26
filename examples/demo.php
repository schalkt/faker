<?php

use Schalkt\Faker\Faker;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker::init();

$words = [];
$words[] = $faker->word(2);
$words[] = $faker->word(3);
$words[] = $faker->word(5);
$words[] = $faker->word(7, 10, Faker::FIRST_VOWEL);
$words[] = $faker->word(14);
$words[] = $faker->words(20, ', ');
$words[] = $faker->sentence(20);
$words[] = $faker->text(20, 3, 7);

print_r($words);

$firstnames = [];
$firstnames[] = $faker->firstname();
$firstnames[] = $faker->firstname(3);
$firstnames[] = $faker->firstname(5);
$firstnames[] = $faker->firstname(7, 10, Faker::FIRST_VOWEL);
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

$chars = [];
$chars[] = $faker->repeat('#', 3, 4, rand(4, 10), '-');
$chars[] = $faker->repeat('.', 4, 4, 7, 'oOo');
$chars[] = $faker->repeat('ACDELMTH23467', 2, 8, rand(4, 6), '-');

print_r($chars);

$emails = [];
$emails[] = $faker->email();
$emails[] = $faker->email();
$emails[] = $faker->email();

print_r($emails);

$passwords = [];
$passwords[] = $faker->password();
$passwords[] = $faker->password(2, 4, 3);
$passwords[] = $faker->password(4, 4, 3, '.');

print_r($passwords);


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
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 50, // percent between 0-100
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
	'vowels' => 'ao',
	'consonants' => 'klmnpr',
	'nextChar' => [
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 0 // percent between 0-100
	],
]);

$names = [];
$names[] = $faker->words(10, ' - ', 3, 3, Faker::FIRST_CONSONANT, ['izi', 'isi', 'iti', 'ini']);

print_r($names);


$faker = Faker::init([
	'vowels' => 'io',
	'consonants' => 'bdrstv',
	'nextChar' => [
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 0 // percent between 0-100
	],
]);

$names = [];
$names[] = $faker->words(7, ' | ', 4, 4, Faker::FIRST_CONSONANT, ['zy', 'sy']);

print_r($names);


$faker = Faker::init([
	'vowels' => 'e',
	'consonants' => 'bhdlmnkpstvz',
	'nextChar' => [
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 0 // percent between 0-100
	],
]);

$sentence = [];
$sentence[] = $faker->sentence(5);
$sentence[] = $faker->sentence(10);

print_r($sentence);


$faker = Faker::init([
	'vowels' => 'io',
	'consonants' => 'bd',
	'nextChar' => [
		'sameChar' => 0, // percent between 0-100
		'sameType' => 0, // percent between 0-100
		'double' => 0 // percent between 0-100
	],
]);

$words = [];
$words[] = strtoupper($faker->words(14, '.', 2, 4));

print_r($words);



