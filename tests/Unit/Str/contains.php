<?php

namespace WPMedia\Extender\Tests\Unit\Str;

use WPMedia\Extender\Str;
use WPMedia\Extender\Tests\Unit\TestCase;

class Test_Contains extends TestCase {

	public function testShouldReturnTrueWhenInSearchString() {
		$searchStr = 'Search string 01234';
		$this->assertTrue( Str::contains( $searchStr, 't' ) );
		$this->assertTrue( Str::contains( $searchStr, 'rch str' ) );
		$this->assertTrue( Str::contains( $searchStr, 4 ) );

		$this->assertTrue( Str::contains( $searchStr, [ 'wp', 59, 123, 'string' ] ) );
		$this->assertTrue( Str::contains( $searchStr, [ 0 ] ) );

		// Check with URLs.
		$this->assertTrue( Str::contains( 'https://example.com', '://' ) );
		$this->assertTrue( Str::contains( 'https://example.com/index.html', 'example.com' ) );
	}

	public function testShouldReturnFalseWhenDoesNotExists() {
		$searchStr = 'Lorem ipsum 98765 01';

		$this->assertFalse( Str::contains( $searchStr, 'T' ) );
		$this->assertFalse( Str::contains( $searchStr, 'rocket' ) );
		$this->assertFalse( Str::contains( $searchStr, 4 ) );

		$this->assertFalse( Str::contains( $searchStr, [ 'wp', 59, 123, 'string' ] ) );
		$this->assertFalse( Str::contains( $searchStr, [ 2 ] ) );

		// Check with URLs.
		$this->assertFalse( Str::contains( 'https://example.com', 'index.html' ) );
		$this->assertFalse( Str::contains( '//example.com/', 'https://' ) );
	}
}
