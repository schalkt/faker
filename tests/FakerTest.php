<?php

namespace Schalkt\Faker\Tests;

use PHPUnit\Framework\TestCase;
use Schalkt\Faker\Faker;

setlocale('LC_ALL', 'hu_HU.UTF-8');

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

		$this->assertNotEmpty($words[0]);
		$this->assertNotEmpty($words[1]);
		$this->assertNotEmpty($words[2]);
		$this->assertNotEmpty($words[3]);
		$this->assertNotEmpty($words[4]);
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
				'sameChar' => 0.0, // percent between 0-1
				'sameType' => 0.0, // percent between 0-1
				'double' => 0.0, // percent between 0-1
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
			'nextChar' => [
				'sameChar' => 0.0, // percent between 0-1
				'sameType' => 0.0, // percent between 0-1
				'double' => 100.0, // percent between 0-1
			],
		]);

		$names = [];
		$names[] = $faker->words(20, ' - ', 2, 20);

		$this->assertGreaterThan(2, substr_count($names[0], 'sh'));
		$this->assertGreaterThan(2, substr_count($names[0], 'th'));

	}
}
