<?php

namespace WPMedia\Extender\Tests\Unit\Str;

use WPMedia\Extender\Str;
use WPMedia\Extender\Tests\Unit\TestCase;

class Test_EndsWith extends TestCase {

	public function testShouldReturnTrueWhenStartStartsWith() {
		$this->assertTrue( Str::endsWith( 'Ends with a space ', ' ' ) );
		$this->assertTrue( Str::endsWith( 'Lorem . period.', '.' ) );

		$this->assertTrue( Str::endsWith( 'Lorem ipsum', 'm' ) );
		$this->assertTrue( Str::endsWith( 'Lorem ipsum', 'm ipsum' ) );
		$this->assertTrue( Str::endsWith( 'Lorem ipsum 12', 12 ) );

		$this->assertTrue( Str::endsWith( 'Lorem ipsum', [ 'wp', ' ipsum', 'Lor' ] ) );
		$this->assertTrue( Str::endsWith( 'Lorem ipsum 12', [ 12 ] ) );
	}

	public function testShouldReturnTrueWhenStartStartsWithNonLatin() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertTrue( Str::endsWith( $searchStr, 'νωθρού κυνός', 'UTF-8' ) );
		$this->assertTrue( Str::endsWith( $searchStr, 'ός', 'UTF-8' ) );
		$this->assertTrue( Str::endsWith( $searchStr, 'δρασκελίζει υπέρ νωθρού κυνός', 'UTF-8' ) );

		$this->assertTrue( Str::endsWith( $searchStr, [ 'αλώπηξ βαφής', 'υπέρ νωθρού κυνός', 'ψημένη γη' ], 'UTF-8' ) );
		$this->assertTrue( Str::endsWith( $searchStr, [ 'ύ κυνός' ], 'UTF-8' ) );
	}

	public function testShouldReturnFalseWhenDoesntStartWith() {
		$this->assertFalse( Str::endsWith( 'Does not end with a space', ' ' ) );
		$this->assertFalse( Str::endsWith( 'Has a period . does not end with .it', '.' ) );

		$this->assertFalse( Str::endsWith( 'Lorem ipsum', 'M' ) );
		$this->assertFalse( Str::endsWith( 'Lorem ipsum', 'lorem ' ) );
		$this->assertFalse( Str::endsWith( 'Lorem ipsum 12', 10 ) );

		$this->assertFalse( Str::endsWith( 'Lorem ipsum', [ 'wp', 'lorem', '1', ' ' ] ) );
		$this->assertFalse( Str::endsWith( 'Lorem ipsum 12', [ 23 ] ) );
	}

	public function testShouldReturnFalseWhenNonLatinDoesntStartWith() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertFalse( Str::endsWith( $searchStr, 'νωθρού κυν', 'UTF-8' ) );
		$this->assertFalse( Str::endsWith( $searchStr, 'υνό', 'UTF-8' ) );
		$this->assertFalse( Str::endsWith( $searchStr, 'δρασκελίζει υπέρ νωθρού κυνό', 'UTF-8' ) );

		$this->assertFalse( Str::endsWith( $searchStr, [ 'αλώπηξ βαφής', 'υπέρ νωθρού', 'ψημένη γη' ], 'UTF-8' ) );
		$this->assertFalse( Str::endsWith( $searchStr, [ 'νωθρού κυνό' ], 'UTF-8' ) );
	}
}
