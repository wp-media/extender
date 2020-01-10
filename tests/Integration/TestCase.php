<?php
/**
 * Test Case for all of the integration tests.
 *
 * @package WPMedia\Extender\Tests\Integration
 */

namespace WPMedia\Extender\Tests\Integration;

use Brain\Monkey;
use WPMedia\Extender\Tests\TestCaseTrait;
use WP_UnitTestCase;

abstract class TestCase extends WP_UnitTestCase {
	use TestCaseTrait;

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
