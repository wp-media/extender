<?php

namespace WPMedia\MicroProfiler;

return [

	'time_multiplier'     => 100000.0, // 1,000.0 is milliseconds; 100,000.0 is microseconds.
	'time_increment_text' => 'microseconds, where 1 µs equals 0.001 ms or 0.000001 second',

	/**
	 * The number of times to profile/exercise each function.
	 */
	'sample_size'         => 500000,

	/**
	 * The list of functions to profile.
	 *
	 * - The key is the function name.
	 * - The value is the profile function to call.
	 */
	'profile_map'         => [
		'Str::contains'   => __NAMESPACE__ . '\profile_Str_contains',
		'Str::startsWith' => __NAMESPACE__ . '\profile_Str_startsWith',
		'Str::endsWith'   => __NAMESPACE__ . '\profile_Str_endsWith',
	],
];
