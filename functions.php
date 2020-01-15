<?php

namespace WPMedia\Extender;

/**
 * Checks if the constant is defined.
 *
 * NOTE: This function allows mocking constants when testing.
 *
 * @since 1.0.0
 *
 * @param string $constant_name Name of the constant to check.
 *
 * @return bool true when constant is defined; else, false.
 */
function has_constant( $constant_name ) {
	return defined( $constant_name );
}

/**
 * Gets the constant is defined.
 *
 * NOTE: This function allows mocking constants when testing.
 *
 * @since 1.0.0
 *
 * @param string     $constant_name Name of the constant to check.
 * @param mixed|null $default       Optional. Default value to return if constant is not defined.
 *
 * @return bool true when constant is defined; else, false.
 */
function get_constant( $constant_name, $default = null ) {
	if ( ! has_constant( $constant_name ) ) {
		return $default;
	}

	return constant( $constant_name );
}

/**
 * Checks if the given search string contains the given character(s) or substring(s).
 *
 * When given array of characters and/or substrings, returns `true` on the first match.
 *
 * @since 1.0.0
 *
 * @param string               $searchStr    String to search.
 * @param string|integer|array $charOrSubstr The character(s) or substring(s) to search for within the search
 *                                           string.
 * @param string|null          $encoding     (Optional) Character encoding. When given, uses multi-byte safe
 *                                           operation. Default: null.
 *
 * @return bool true when found; else false.
 */
function str_contains( $searchStr, $charOrSubstr, $encoding = null ) {
	return Str::contains( $searchStr, $charOrSubstr, $encoding );
}

/**
 * Checks if a given search string starts with the given character(s) or substring(s).
 *
 * When given array of characters and/or substrings, returns `true` on the first match.
 *
 * @since 1.0.0
 *
 * @param string               $searchStr    String to search.
 * @param string|integer|array $charOrSubstr The character(s) or substring(s) to search for within the search
 *                                           string.
 * @param string|null          $encoding     (Optional) Character encoding. When given, uses multi-byte safe
 *                                           operation. Default: null.
 *
 * @return bool true when search string starts with the given character or substring; else false.
 */
function str_ends_with( $searchStr, $charOrSubstr, $encoding = null ) {
	return Str::endsWith( $searchStr, $charOrSubstr, $encoding );
}

/**
 * Checks if a given search string starts with the given character(s) or substring(s).
 *
 * When given array of characters and/or substrings, returns `true` on the first match.
 *
 * @since 1.0.0
 *
 * @param string               $searchStr    String to search.
 * @param string|integer|array $charOrSubstr The character(s) or substring(s) to search for within the search
 *                                           string.
 * @param string|null          $encoding     (Optional) Character encoding. When given, uses multi-byte safe
 *                                           operation. Default: null.
 *
 * @return bool true when search string starts with the given character or substring; else false.
 */
function str_starts_with( $searchStr, $charOrSubstr, $encoding = null ) {
	return Str::startsWith( $searchStr, $charOrSubstr, $encoding );
}
