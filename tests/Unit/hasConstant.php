<?php

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\has_constant;
use Brain\Monkey;

/**
 * @group Constants
 */
class Test_HasConstant extends TestCase {
	protected function setUp() {
		parent::setUp();

		require_once EXTENDER_ROOT_DIR . 'functions.php';
	}

	/**
	 * Test has_constant() should mock constants, allowing tests to override if a constant is defined or not.
	 */
	public function testShouldMockConstants() {
		Monkey\Functions\expect( '\WPMedia\Extender\has_constant' )
			->ordered()
			->once()
			->with( 'THIS_CONSTANT_DOES_NOT_EXIST' )
			->andReturn( true )
			->andAlsoExpectIt()
			->once()
			->with( 'EXTENDER_TESTS_ROOT' )
			->andReturn( false );

		$this->assertTrue( has_constant( 'THIS_CONSTANT_DOES_NOT_EXIST' ) );
		// This constant is defined in the test suite's bootstrapping.
		$this->assertFalse( has_constant( 'EXTENDER_TESTS_ROOT' ) );
	}

	public function testShouldReturnFalseWhenConstantNotDefined() {
		$this->assertFalse( has_constant( 'THIS_CONSTANT_DOES_NOT_EXIST' ) );
	}

	public function testShouldReturnTrueWhenConstantIsDefined() {
		$this->assertTrue( has_constant( 'EXTENDER_ROOT_DIR' ) );
		$this->assertTrue( has_constant( 'EXTENDER_TESTS_ROOT' ) );
	}
}
