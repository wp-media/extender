<?php

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\str_contains;

class Test_StrContains extends TestCase {

	public function testShouldReturnTrueWhenInSearchString() {
		$searchStr = 'Search string 01234';

		$this->assertTrue( str_contains( $searchStr, 't' ) );
		$this->assertTrue( str_contains( $searchStr, 'rch str' ) );
		$this->assertTrue( str_contains( $searchStr, 4 ) );

		$this->assertTrue( str_contains( $searchStr, [ 'wp', 59, 123, 'string' ] ) );
		$this->assertTrue( str_contains( $searchStr, [ 0 ] ) );

		// Check with URLs.
		$this->assertTrue( str_contains( 'https://example.com', '://' ) );
		$this->assertTrue( str_contains( 'https://example.com/index.html', 'example.com' ) );
	}

	public function testShouldReturnFalseWhenDoesNotExists() {
		$searchStr = 'Lorem ipsum 98765 01';

		$this->assertFalse( str_contains( $searchStr, 'T' ) );
		$this->assertFalse( str_contains( $searchStr, 'rocket' ) );
		$this->assertFalse( str_contains( $searchStr, 4 ) );

		$this->assertFalse( str_contains( $searchStr, [ 'wp', 59, 123, 'string' ] ) );
		$this->assertFalse( str_contains( $searchStr, [ 2 ] ) );

		// Check with URLs.
		$this->assertFalse( str_contains( 'https://example.com', 'index.html' ) );
		$this->assertFalse( str_contains( '//example.com/', 'https://' ) );
	}
}
