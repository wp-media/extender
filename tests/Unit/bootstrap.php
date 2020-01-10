<?php
/**
 * Bootstraps the Unit Tests.
 *
 * @package WPMedia\Extender\Tests\Unit
 */

namespace WPMedia\Extender\Tests\Unit;

use function WPMedia\Extender\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/bootstrap-functions.php';
init_test_suite( 'Unit' );
