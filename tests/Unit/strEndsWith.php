<?php

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\str_ends_with;

class Test_StrEndsWith extends TestCase {

	public function testShouldReturnTrueWhenEndsWith() {
		$this->assertTrue( str_ends_with( 'Ends with a space ', ' ' ) );
		$this->assertTrue( str_ends_with( 'Lorem . period.', '.' ) );

		$this->assertTrue( str_ends_with( 'Lorem ipsum', 'm' ) );
		$this->assertTrue( str_ends_with( 'Lorem ipsum', 'm ipsum' ) );
		$this->assertTrue( str_ends_with( 'Lorem ipsum 12', 12 ) );

		$this->assertTrue( str_ends_with( 'Lorem ipsum', [ 'wp', ' ipsum', 'Lor' ] ) );
		$this->assertTrue( str_ends_with( 'Lorem ipsum 12', [ 12 ] ) );
	}

	public function testShouldReturnTrueWhenEndsWithNonLatin() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertTrue( str_ends_with( $searchStr, 'νωθρού κυνός', 'UTF-8' ) );
		$this->assertTrue( str_ends_with( $searchStr, 'ός', 'UTF-8' ) );
		$this->assertTrue( str_ends_with( $searchStr, 'δρασκελίζει υπέρ νωθρού κυνός', 'UTF-8' ) );

		$this->assertTrue( str_ends_with( $searchStr, [ 'αλώπηξ βαφής', 'υπέρ νωθρού κυνός', 'ψημένη γη' ], 'UTF-8' ) );
		$this->assertTrue( str_ends_with( $searchStr, [ 'ύ κυνός' ], 'UTF-8' ) );
	}

	public function testShouldReturnFalseWhenDoesntEndWith() {
		$this->assertFalse( str_ends_with( 'Does not end with a space', ' ' ) );
		$this->assertFalse( str_ends_with( 'Has a period . does not end with .it', '.' ) );

		$this->assertFalse( str_ends_with( 'Lorem ipsum', 'M' ) );
		$this->assertFalse( str_ends_with( 'Lorem ipsum', 'lorem ' ) );
		$this->assertFalse( str_ends_with( 'Lorem ipsum 12', 10 ) );

		$this->assertFalse( str_ends_with( 'Lorem ipsum', [ 'wp', 'lorem', '1', ' ' ] ) );
		$this->assertFalse( str_ends_with( 'Lorem ipsum 12', [ 23 ] ) );
	}

	public function testShouldReturnFalseWhenNonLatinDoesntEndWith() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertFalse( str_ends_with( $searchStr, 'νωθρού κυν', 'UTF-8' ) );
		$this->assertFalse( str_ends_with( $searchStr, 'υνό', 'UTF-8' ) );
		$this->assertFalse( str_ends_with( $searchStr, 'δρασκελίζει υπέρ νωθρού κυνό', 'UTF-8' ) );

		$this->assertFalse( str_ends_with( $searchStr, [ 'αλώπηξ βαφής', 'υπέρ νωθρού', 'ψημένη γη' ], 'UTF-8' ) );
		$this->assertFalse( str_ends_with( $searchStr, [ 'νωθρού κυνό' ], 'UTF-8' ) );
	}
}
