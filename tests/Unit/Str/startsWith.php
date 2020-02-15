<?php

namespace WPMedia\Extender\Tests\Unit\Str;

use WPMedia\Extender\Str;
use WPMedia\Extender\Tests\Unit\TestCase;

class Test_StartsWith extends TestCase {

	public function testShouldReturnTrueWhenStartStartsWith() {
		$this->assertTrue( Str::startsWith( ' Lorem ipsum', ' ' ) );
		$this->assertTrue( Str::startsWith( ', lorem ipsum', ',' ) );

		$this->assertTrue( Str::startsWith( 'Lorem ipsum', 'L' ) );
		$this->assertTrue( Str::startsWith( 'Lorem ipsum', 'Lorem ' ) );
		$this->assertTrue( Str::startsWith( '12 Lorem ipsum', 12 ) );

		$this->assertTrue( Str::startsWith( 'Lorem ipsum', [ 'wp', 'ipsum', 'Lor' ] ) );
		$this->assertTrue( Str::startsWith( '12 Lorem ipsum', [ 12 ] ) );

		// Check with URLs.
		$this->assertTrue( Str::startsWith( 'https://example.com', 'http' ) );
		$this->assertTrue( Str::startsWith( 'https://example.com', 'https' ) );
		$this->assertTrue( Str::startsWith( '//example.com/index.html', '//' ) );
	}

	public function testShouldReturnTrueWhenStartStartsWithNonLatin() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertTrue( Str::startsWith( $searchStr, 'Τάχ', 'UTF-8' ) );
		$this->assertTrue( Str::startsWith( $searchStr, 'Τάχιστη', 'UTF-8' ) );
		$this->assertTrue( Str::startsWith( $searchStr, 'Τάχιστη αλώπηξ', 'UTF-8' ) );
		$this->assertTrue( Str::startsWith( $searchStr, 'Τάχ', 'UTF-8' ) );

		$this->assertTrue( Str::startsWith( $searchStr, [ 'wp', 'Τάχιστη', 'Lor' ], 'UTF-8' ) );
		$this->assertTrue( Str::startsWith( $searchStr, [ 'Τά' ], 'UTF-8' ) );
	}

	public function testShouldReturnFalseWhenDoesntStartWith() {
		$this->assertFalse( Str::startsWith( 'Does not start with a space', ' ' ) );
		$this->assertFalse( Str::startsWith( 'Has a period . does not start with it.', '.' ) );

		$this->assertFalse( Str::startsWith( 'Lorem ipsum', 'l' ) );
		$this->assertFalse( Str::startsWith( 'Lorem ipsum', 'lorem ' ) );
		$this->assertFalse( Str::startsWith( '12 Lorem ipsum', 10 ) );

		$this->assertFalse( Str::startsWith( 'Lorem ipsum', [ 'wp', 'ipsum', 'lorem' ] ) );
		$this->assertFalse( Str::startsWith( '12 Lorem ipsum', [ 23 ] ) );

		// Check with URLs.
		$this->assertFalse( Str::startsWith( 'https://example.com', 'http://' ) );
		$this->assertFalse( Str::startsWith( '//example.com/index.html', 'https://' ) );
	}

	public function testShouldReturnFalseWhenNonLatinDoesntStartWith() {
		$searchStr = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";

		$this->assertFalse( Str::startsWith( $searchStr, 'άχιστη', 'UTF-8' ) );
		$this->assertFalse( Str::startsWith( $searchStr, 'αλώπηξ', 'UTF-8' ) );

		$this->assertFalse( Str::startsWith( $searchStr, [ 'wp', 'άχιστη', 'Lor' ], 'UTF-8' ) );
		$this->assertFalse( Str::startsWith( $searchStr, [ ' ' ], 'UTF-8' ) );
	}
}
