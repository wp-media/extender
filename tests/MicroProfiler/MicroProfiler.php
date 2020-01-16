<?php

namespace WPMedia\MicroProfiler;

use Brain\Monkey;
use WP_UnitTestCase;

class MicroProfiler extends WP_UnitTestCase {

	/**
	 * Sample size for the profiler.
	 *
	 * @var []
	 */
	protected $config;


	/**
	 * Array of micro profiles.
	 *
	 * @var []
	 */
	protected $profiles = [];

	/**
	 * Instance of the logger.
	 *
	 * @var Logger
	 */
	protected $logger;

	/**
	 * Indicates if running the baseline microprofiler.
	 *
	 * @var bool
	 */
	protected $runningBaseline;

	/**
	 * Set up the test.
	 */
	public function setUp() {
		parent::setUp();
		Monkey\setUp();

		global $argv;
		$this->runningBaseline = ( 'microprofiler-baseline' === $argv[2] );
		$this->config          = require __DIR__ . '/config/microprofiler.php';
		$this->logger          = new Logger( $this->config['sample_size'], $this->config['time_increment_text'], $this->runningBaseline );

		$this->set_permalink_structure( '/%year%/%monthnum%/%day%/%postname%/' );
		$this->initProfiles();
	}

	/**
	 * Run the profiler.
	 */
	public function testRunMicroProfiler() {
		$index = 0;

		do_action( 'microprofiler_setup_tasks' );

		do {

			// Invoke each of the registered functions to profile.
			foreach ( $this->config['profile_map'] as $function ) {
				$function( $this );
			}

			$index ++;
		} while ( $index < $this->config['sample_size'] );

		$this->runStats();
		$this->logger->printSummary( $this->profiles );

		do_action( 'microprofiler_cleanup_tasks' );

		exit;
	}

	/**
	 * Starts the microprofiler for this segment.
	 *
	 * @since 1.0.0
	 *
	 * @param string $name Name for this segment.
	 *
	 * @return void
	 */
	public function startSegment( $name ) {
		$this->profiles[ $name ]->startSegment();
	}

	/**
	 * Starts the microprofiler for this segment.
	 *
	 * @since 1.0.0
	 *
	 * @param string $name Name for this segment.
	 *
	 * @return void
	 */
	public function stopSegment( $name ) {
		$this->profiles[ $name ]->stopSegment();
	}

	/**
	 * Initialize the profiles for the functions to be profiled.
	 */
	protected function initProfiles() {
		$this->profiles = [];

		foreach ( array_keys( $this->config['profile_map'] ) as $profileName ) {
			$this->profiles[ $profileName ] = new Profile( $this->config['time_multiplier'] );
		}
	}

	/**
	 * Run the statistics on the profiles.
	 *
	 * @since 1.0.0
	 */
	protected function runStats() {
		if ( $this->runningBaseline ) {
			foreach ( $this->profiles as $name => $profile ) {
				$profile->runStats( $name );
			}

			return;
		}

		$baselineResults = $this->logger->getBaselineResults();
		foreach ( $this->profiles as $name => $profile ) {
			$profile->runStats( $baselineResults[ $name ] );
		}
	}
}
