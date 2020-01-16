<?php

namespace WPMedia\MicroProfiler;

class Profile {

	/**
	 * The segment's start time (in milliseconds).
	 *
	 * @var float
	 */
	private $startTime = 0.0;

	/**
	 * The total, accumulative execution times.
	 *
	 * @var float
	 */
	private $totalTimes = 0.0;

	/**
	 * Average number of milliseconds.
	 *
	 * @var float
	 */
	protected $avgTime = 0.0;

	/**
	 * The number of times collected in this profile.
	 *
	 * @var int
	 */
	protected $sampleSize = 0;

	/**
	 * The baseline's average milliseconds, used for comparison to determine if the change
	 * as impacted the function's execution time.
	 *
	 * @var float
	 */
	protected $baseline = 0.0;

	/**
	 * Difference to the baseline's averge milliseconds.
	 *
	 * @var float
	 */
	protected $timeDifference = 0.0;

	/**
	 * Configured time multiplier for milliseconds, microseconds, etc.
	 *
	 * @var float
	 */
	private $timeMultiplier = 1000.0;

	/**
	 * Profile constructor.
	 *
	 * @param float $timeMultiplier Configured time multiplier for milliseconds, microseconds, etc.
	 */
	public function __construct( $timeMultiplier ) {
		$this->timeMultiplier = $timeMultiplier;
	}

	/**
	 * Start the segment.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function startSegment() {
		$this->sampleSize ++;
		$this->startTime = $this->getCurrentTime();
	}

	/**
	 * Stop the segment.
	 *
	 * @since 1.0.0
	 */
	public function stopSegment() {
		$this->totalTimes += $this->getCurrentTime() - $this->startTime;

		// Reset the start time.
		$this->startTime = 0.0;
	}

	/**
	 * Run the statistics on the profiles.
	 *
	 * @since 1.0.0
	 *
	 * @param float $baselineAvgTime The baseline's average time.
	 */
	public function runStats( $baselineAvgTime = 0.0 ) {
		$this->baseline        = (float) $baselineAvgTime;
		$this->avgTime        = $this->totalTimes / $this->sampleSize;
		$this->timeDifference = $this->avgTime - $this->baseline;

		$this->totalTimes = 0.0;
		$this->sampleSize = 0.0;
	}

	/**
	 * Get the property's value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $property Property to get.
	 *
	 * @return mixed
	 */
	public function get( $property ) {
		if ( property_exists( $this, $property ) ) {
			return $this->$property;
		}
	}

	/**
	 * Get current time increment.
	 *
	 * @since 1.0.0
	 *
	 * @return float
	 */
	protected function getCurrentTime() {
		return microtime( true ) * $this->timeMultiplier;
	}
}
