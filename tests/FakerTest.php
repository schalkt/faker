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
		$words[] = $faker->word();
		$words[] = $faker->word(3);
		$words[] = $faker->word(5);
		$words[] = $faker->word(7, Faker::FIRST_VOWEL);
		$words[] = $faker->word(14);

		print_r($words);

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
		$codes[] = $faker->mask('####-####-####-####');
		$codes[] = $faker->mask('######...######', 'dilemma');

		print_r($codes);
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
		$numbers[] = $faker->intmask('###-###-###-#-#-#', 0, 1);


		print_r($numbers);

		$this->assertEquals(true, $numbers[0] > 0);
		$this->assertEquals(true, $numbers[1] >= 1000000);
		$this->assertEquals(true, strlen($numbers[2]) === 17);
	}
}
