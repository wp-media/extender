<?php

namespace WPMedia\MicroProfiler;

use WPMedia\Extender\Str;

/**
 * Profile Str::contains().
 *
 * @since 1.0.0
 *
 * @param MicroProfiler $profiler Instance of the Micro Profiler.
 */
function profile_Str_contains( MicroProfiler $profiler ) {
	$profiler->startSegment( 'Str::contains' );
	Str::contains( 'https://example.com/index.html', 'example.com' );
	$profiler->stopSegment( 'Str::contains' );
}

/**
 * Profile Str::startsWith().
 *
 * @since 1.0.0
 *
 * @param MicroProfiler $profiler Instance of the Micro Profiler.
 */
function profile_Str_startsWith( MicroProfiler $profiler ) {
	$profiler->startSegment( 'Str::startsWith' );
	Str::startsWith( 'https://example.com/index.html', 'http' );
	$profiler->stopSegment( 'Str::startsWith' );
}

/**
 * Profile Str::endsWith().
 *
 * @since 1.0.0
 *
 * @param MicroProfiler $profiler Instance of the Micro Profiler.
 */
function profile_Str_endsWith( MicroProfiler $profiler ) {
	$profiler->startSegment( 'Str::endsWith' );
	Str::endsWith( 'https://example.com/index.html', 'index.html' );
	$profiler->stopSegment( 'Str::endsWith' );
}
