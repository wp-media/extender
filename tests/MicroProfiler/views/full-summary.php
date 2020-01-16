
-------------------------
MICRO PROFILER REPORT:
-------------------------

PHP version:        <?php echo phpversion() . "\n"; ?>
Sample Size:        <?php echo number_format( $this->sampleSize ); ?> (per function)
Time Increments:    <?php echo $this->timeIncrementText; ?>

  --------------------------------   -------------   -------------   -------------
| Name                             | Result        |  Avg Time     | Baseline
|                                  | (ms)          |  (ms)         | (ms)
| -------------------------------- | ------------- | ------------- | -------------
<?php
foreach ( $this->profiles as $name => $profile ) {
	$this->printSegment( $name, $profile );
}
?>
 --------------------------------   -------------   -------------   -------------

NOTES:

1. The functions were invoked/exercised <?php echo number_format( $this->sampleSize ); ?> times during this microprofiler process.
2. The 'diff' column = 'time' - 'baseline'.
3. The 'time' column shows the function/method's average execution time.
