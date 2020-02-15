<?php

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\get_constant;
use Brain\Monkey;

/**
 * @group Constants
 */
class Test_GetConstant extends TestCase {
	protected function setUp() {
		parent::setUp();

		require_once EXTENDER_ROOT_DIR . 'functions.php';
	}

	/**
	 * Test get_constant() should mock getting constants, allowing tests to override what gets returned.
	 */
	public function testShouldMockConstants() {
		Monkey\Functions\expect( '\WPMedia\Extender\get_constant' )
			->ordered()
			->once()
			->with( 'THIS_CONSTANT_DOES_NOT_EXIST' )
			->andReturn( 'Hello World' )
			->andAlsoExpectIt()
			->once()
			->with( 'EXTENDER_TESTS_ROOT' )
			->andReturn( 'Hello World' );

		$this->assertSame( 'Hello World', get_constant( 'THIS_CONSTANT_DOES_NOT_EXIST' ) );
		$this->assertSame( 'Hello World', get_constant( 'EXTENDER_TESTS_ROOT' ) );
	}

	public function testShouldReturnDefaultWhenConstantNotDefined() {
		$this->assertNull( get_constant( 'THIS_CONSTANT_DOES_NOT_EXIST' ) );
		$this->assertSame( 'Hello World', get_constant( 'THIS_CONSTANT_DOES_NOT_EXIST', 'Hello World' ) );
	}

	public function testShouldReturnConstantWhenDefined() {
		$this->assertSame( EXTENDER_ROOT_DIR, get_constant( 'EXTENDER_ROOT_DIR' ) );
		$this->assertSame( EXTENDER_TESTS_ROOT, get_constant( 'EXTENDER_TESTS_ROOT' ) );
	}
}
