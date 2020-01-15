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
