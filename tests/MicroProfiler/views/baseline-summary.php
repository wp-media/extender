
-------------------------
MICRO PROFILER REPORT:
-------------------------

PHP version:        <?php echo phpversion() . "\n"; ?>
Sample Size:        <?php echo number_format( $this->sampleSize ); ?> (per function)
Time Increments:    <?php echo $this->timeIncrementText; ?>

 --------------------------------   -------------
| Name                             | Avg Time     |
|                                  | (µs)         |
| -------------------------------- | ------------ |
<?php
foreach ( $this->profiles as $name => $profile ) {
	printf( "| %-30s   |    %0.6f  |\n", $name, $profile->get( 'avgTime' ) ); // @codingStandardsIgnoreLine.
}
?>
 --------------------------------   -------------

NOTES:

1. The functions were invoked/exercised <?php echo number_format( $this->sampleSize ); ?> times during this microprofiler process.
2. The 'time' column shows the function/method's average execution time.
