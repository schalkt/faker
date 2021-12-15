<?php

namespace Schalkt\Faker\Tests;

use PHPUnit\Framework\TestCase;
use Schalkt\Faker\Faker;

final class FakerTest extends TestCase
{

	/**
	 * testWords
	 *
	 * @return void
	 */
	public function testWords()
	{

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

		$this->assertEquals(2, strlen($words[0]));
		$this->assertEquals(3, strlen($words[1]));
		$this->assertEquals(5, strlen($words[2]));
		$this->assertEquals(7, strlen($words[3]));
		$this->assertEquals(14, strlen($words[4]));

		$firstnames = [];
		$firstnames[] = $faker->firstname();
		$firstnames[] = $faker->firstname(3);
		$firstnames[] = $faker->firstname(5);
		$firstnames[] = $faker->firstname(7, Faker::FIRST_VOWEL);
		$firstnames[] = $faker->firstname(14);

		$fullnames = [];
		$fullnames[] = $faker->fullname();
		$fullnames[] = $faker->fullname(4, 7);
		$fullnames[] = $faker->fullname(5, 10);
		$fullnames[] = $faker->fullname(7, 7, true);
		$fullnames[] = $faker->fullname(6, 8);
		$fullnames[] = $faker->fullname(3, 3);
		$fullnames[] = $faker->fullname(4, 2);

		$codes = [];
		$codes[] = $faker->mask();
		$codes[] = $faker->mask('####-####-####-####', 'ABCD');
		$codes[] = $faker->mask('##.##.##.##.##.##', 'dilemma');
	}


	/**
	 * testNumbers
	 *
	 * @return void
	 */
	public function testNumbers()
	{

		$faker = Faker::init();

		$numbers = [];
		$numbers[] = $faker->int(1);
		$numbers[] = $faker->int(1000000, 9000000);
		$numbers[] = $faker->mask('###-###-###-#-#-#', '01');
		$numbers[] = $faker->boolean() ? 'true' : 'false';

		$this->assertEquals(true, $numbers[0] > 0);
		$this->assertEquals(true, $numbers[1] >= 1000000);
		$this->assertEquals(true, strlen($numbers[2]) === 17);
	}


	/**
	 * testOptions
	 *
	 * @return void
	 */
	public function testOptions()
	{

		$faker = Faker::init([
			'vowels' => 'iea',
			'consonants' => 'dlm',
			'nextChar' => [
				'sameChar' => 0, // percent between 0-100
				'sameType' => 0, // percent between 0-100
				'double' => 50, // percent between 0-100
			]
		]);

		$wordsNext = [];
		$wordsNext[] = $faker->word(2);
		$wordsNext[] = $faker->word(3);
		$wordsNext[] = $faker->word(5);
		$wordsNext[] = $faker->word(7, Faker::FIRST_VOWEL);
		$wordsNext[] = $faker->word(14);
		$wordsNext[] = $faker->words(20, ', ');
		$wordsNext[] = $faker->sentence(7);

		$this->assertNotEmpty($wordsNext[0]);
		$this->assertNotEmpty($wordsNext[1]);
		$this->assertNotEmpty($wordsNext[2]);
		$this->assertNotEmpty($wordsNext[3]);
		$this->assertNotEmpty($wordsNext[4]);
	}


	/**
	 * testFunnyNames
	 *
	 * @return void
	 */
	public function testFunnyNames()
	{

		$faker = Faker::init([
			'vowels' => 'aeiouöüáé',
			'consonants' => 'bcdfghjklmnprstvz',
			'nextChar' => [
				'sameChar' => 0, // percent between 0-100
				'sameType' => 0, // percent between 0-100
				'double' => 0, // percent between 0-100
			],
		]);

		$names = [];
		$names[] = $faker->words(20, ', ', 2, 5, Faker::FIRST_CONSONANT, ['ike', 'iszi']);

		$this->assertGreaterThan(2, substr_count($names[0], 'ike'));
		$this->assertGreaterThan(2, substr_count($names[0], 'iszi'));
	}


	/**
	 * testDoubles
	 *
	 * @return void
	 */
	public function testDoubles()
	{

		$faker = Faker::init([
			'consonantsDouble' => ['sh', 'th'],
			'vowelsDouble' => ['oo', 'ee'],
			'nextChar' => [
				'sameChar' => 0, // percent between 0-100
				'sameType' => 0, // percent between 0-100
				'double' => 100, // percent between 0-100
			],
		]);

		$names = [];
		$names[] = $faker->words(20, ' - ', 2, 20);

		$this->assertGreaterThan(2, substr_count($names[0], 'sh'));
		$this->assertGreaterThan(2, substr_count($names[0], 'th'));
	}

	/**
	 * testEmails
	 *
	 * @return void
	 */
	public function testEmails()
	{

		$faker = Faker::init();

		$emails = [];
		$emails[] = $faker->email();
		$emails[] = $faker->email();
		$emails[] = $faker->email();
		$emails[] = $faker->email();

		$this->assertEquals($emails[0], \filter_var($emails[0], \FILTER_VALIDATE_EMAIL));
		$this->assertEquals($emails[1], \filter_var($emails[1], \FILTER_VALIDATE_EMAIL));
		$this->assertEquals($emails[2], \filter_var($emails[2], \FILTER_VALIDATE_EMAIL));
		$this->assertEquals($emails[3], \filter_var($emails[3], \FILTER_VALIDATE_EMAIL));
	}

	/**
	 * testRepeats
	 *
	 * @return void
	 */
	public function testRepeats()
	{

		$faker = Faker::init();

		$chars = [];
		$chars[] = $faker->repeat('.', 4, 4, 3, 'oOo');

		$this->assertEquals('....oOo....oOo....', $chars[0]);
	}

	/**
	 * testPasswords
	 *
	 * @return void
	 */
	public function testPasswords()
	{

		$faker = Faker::init();

		$passwords = [];
		$passwords[] = $faker->password(4, 4, 3, '.');

		$this->assertEquals(14, strlen($passwords[0]));
	}
}
