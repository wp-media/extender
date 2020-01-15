<?php

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\str_starts_with;

class Test_StartsWith extends TestCase {

	public function testShouldReturnTrueWhenStartStartsWith() {
		$this->assertTrue( str_starts_with( ' Lorem ipsum', ' ' ) );
		$this->assertTrue( str_starts_with( ', lorem ipsum', ',' ) );

		$this->assertTrue( str_starts_with( 'Lorem ipsum', 'L' ) );
		$this->assertTrue( str_starts_with( 'Lorem ipsum', 'Lorem ' ) );
		$this->assertTrue( str_starts_with( '12 Lorem ipsum', 12 ) );

		$this->assertTrue( str_starts_with( 'Lorem ipsum', [ 'wp', 'ipsum', 'Lor' ] ) );
		$this->assertTrue( str_starts_with( '12 Lorem ipsum', [ 12 ] ) );
	}

	public function testShouldReturnTrueWhenStartStartsWithNonLatin() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertTrue( str_starts_with( $searchStr, 'Τάχ', 'UTF-8' ) );
		$this->assertTrue( str_starts_with( $searchStr, 'Τάχιστη', 'UTF-8' ) );
		$this->assertTrue( str_starts_with( $searchStr, 'Τάχιστη αλώπηξ', 'UTF-8' ) );
		$this->assertTrue( str_starts_with( $searchStr, 'Τάχ', 'UTF-8' ) );

		$this->assertTrue( str_starts_with( $searchStr, [ 'wp', 'Τάχιστη', 'Lor' ], 'UTF-8' ) );
		$this->assertTrue( str_starts_with( $searchStr, [ 'Τά' ], 'UTF-8' ) );
	}

	public function testShouldReturnFalseWhenDoesntStartWith() {
		$this->assertFalse( str_starts_with( 'Does not start with a space', ' ' ) );
		$this->assertFalse( str_starts_with( 'Has a period . does not start with it.', '.' ) );

		$this->assertFalse( str_starts_with( 'Lorem ipsum', 'l' ) );
		$this->assertFalse( str_starts_with( 'Lorem ipsum', 'lorem ' ) );
		$this->assertFalse( str_starts_with( '12 Lorem ipsum', 10 ) );

		$this->assertFalse( str_starts_with( 'Lorem ipsum', [ 'wp', 'ipsum', 'lorem' ] ) );
		$this->assertFalse( str_starts_with( '12 Lorem ipsum', [ 23 ] ) );
	}

	public function testShouldReturnFalseWhenNonLatinDoesntStartWith() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertFalse( str_starts_with( $searchStr, 'άχιστη', 'UTF-8' ) );
		$this->assertFalse( str_starts_with( $searchStr, 'αλώπηξ', 'UTF-8' ) );

		$this->assertFalse( str_starts_with( $searchStr, [ 'wp', 'άχιστη', 'Lor' ], 'UTF-8' ) );
		$this->assertFalse( str_starts_with( $searchStr, [ ' ' ], 'UTF-8' ) );
	}
}
