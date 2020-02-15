<?php

namespace WPMedia\MicroProfiler;

class Logger {

	/**
	 * Array of micro profiles.
	 *
	 * @var array
	 */
	protected $profiles = [];

	/**
	 * Absolute path to the baseline results file.
	 *
	 * @var string
	 */
	protected $baselineFile;

	/**
	 * Indicates if running the baseline microprofiler.
	 *
	 * @var bool
	 */
	protected $runningBaseline;

	/**
	 * Sample size for the profiler.
	 *
	 * @var int
	 */
	protected $sampleSize;

	protected $timeIncrementText;

	/**
	 * Logger constructor.
	 *
	 * @param int  $sampleSize Sample size for the profiler.
	 * @param bool $runningBaseline
	 */
	public function __construct( $sampleSize, $timeIncrementText, $runningBaseline ) {
		$this->sampleSize        = $sampleSize;
		$this->timeIncrementText = $timeIncrementText;
		$this->runningBaseline   = $runningBaseline;
		$this->baselineFile      = __DIR__ . '/config/baseline.php';
	}

	/**
	 * Print the summary.
	 *
	 * @since 1.0.0
	 *
	 * @param array $profiles Array of profiles.
	 *
	 * @return void
	 */
	public function printSummary( array $profiles ) {
		$this->profiles = $profiles;

		if ( $this->runningBaseline ) {
			require __DIR__ . '/views/baseline-summary.php';
			$this->storeBaselineResults();
		} else {
			require __DIR__ . '/views/full-summary.php';
		}

		$this->profiles = null;
	}

	/**
	 * Get the baseline results.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function getBaselineResults() {
		return (array) json_decode( file_get_contents( $this->baselineFile ) ); // @codingStandardsIgnoreLine.
	}

	/**
	 * Store the baseline results.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function storeBaselineResults() {
		$results = [];

		foreach ( $this->profiles as $name => $profile ) {
			$results[ $name ] = $profile->get( 'avgTime' );
		}

		// Store the results in a file.
		file_put_contents( $this->baselineFile, json_encode( $results ) ); // @codingStandardsIgnoreLine.
	}

	/**
	 * Print the full segment.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $name    Name of the profile.
	 * @param Profile $profile The given profile to print out.
	 *
	 * @return void
	 */
	protected function printSegment( $name, Profile $profile ) {
		$timeDifference = $profile->get( 'timeDifference' );
		$color          = $this->getColor( $timeDifference );

		if ( $color ) {
			printf( "|\033[%sm %-30s \033[0m  ", $color, $name ); // @codingStandardsIgnoreLine.

			// Need to compensate for the negative sign.
			if ( $timeDifference < 0.0 ) {
				printf( "|   \033[%sm %0.6f \033[0m ", $color, $timeDifference ); // @codingStandardsIgnoreLine.
			} else {
				printf( "|    \033[%sm %0.6f \033[0m ", $color, $timeDifference ); // @codingStandardsIgnoreLine.
			}
		} else {
			printf( "| %-30s ", $name ); // @codingStandardsIgnoreLine.

			// Need to compensate for the negative sign.
			if ( $timeDifference < 0.0 ) {
				printf( "|   %0.6f ", $timeDifference ); // @codingStandardsIgnoreLine.
			} else {
				printf( "|    %0.6f ", $timeDifference ); // @codingStandardsIgnoreLine.
			}
		}

		printf( "|      %0.6f |      %0.6f \n", $profile->get( 'avgTime' ), $profile->get( 'baseline' ) ); // @codingStandardsIgnoreLine.
	}

	/**
	 * Get the color.
	 *
	 * @since 1.0.0
	 *
	 * @param float $difference The difference from the baseline time.
	 *
	 * @return string
	 */
	protected function getColor( $difference ) {

		// If we increased by at least 0.1 ms, return a "red" background.
		if ( $difference >= 0.1 ) {
			return '41';
		}

		// If we increased by at least 0.01 ms, return a "red" color.
		if ( $difference > 0.01 ) {
			return '31';
		}

		// If we increased by at least 0.001 ms, return a "yellow" color.
		if ( $difference > 0.001 ) {
			return '1;33';
		}

		// If we decreased by at least 0.01ms, return a "green" background.
		if ( $difference < 0.01 ) {
			return '32';
		}

		// If we decreased, return a "green" color.
		if ( $difference < 0.0 ) {
			return '32';
		}
	}
}
