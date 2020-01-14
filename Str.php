<?php

namespace WPMedia\Extender;

class Str {

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
	public static function contains( $searchStr, $charOrSubstr, $encoding = null ) {
		if ( ! is_string( $searchStr ) || '' === $searchStr || empty( $charOrSubstr ) ) {
			return false;
		}

		if ( ! is_array( $charOrSubstr ) ) {
			return ( self::getPos( $searchStr, $charOrSubstr, 0, $encoding ) !== false );
		}

		foreach ( $charOrSubstr as $needle ) {
			if ( '' === $needle ) {
				continue;
			}

			if ( self::getPos( $searchStr, $needle, 0, $encoding ) !== false ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Gets the position of the first occurrence of the character or substring (needle) in given search string
	 * (haystack).
	 *
	 * @since 1.0.0
	 *
	 * @param string               $searchStr    String to search.
	 * @param string|integer|array $charOrSubstr The character(s) or substring(s) to search for within the search
	 *                                           string.
	 * @param int                  $offset       (Optional) Search offset. Default: 0.
	 * @param string|null          $encoding     (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return bool|false|int position of 1st occurrence; if doesn't exist, returns false.
	 */
	protected static function getPos( $searchStr, $charOrSubstr, $offset = 0, $encoding = null ) {
		return $encoding
			? mb_strpos( $searchStr, (string) $charOrSubstr, $offset, $encoding )
			: strpos( $searchStr, (string) $charOrSubstr, $offset );
	}
}
