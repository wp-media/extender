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
		if ( ! is_string( $searchStr ) || '' === $searchStr ) {
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
	public static function endsWith( $searchStr, $charOrSubstr, $encoding = null ) {
		return self::matches( $searchStr, $charOrSubstr, -1, $encoding );
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
	public static function startsWith( $searchStr, $charOrSubstr, $encoding = null ) {
		return self::matches( $searchStr, $charOrSubstr, 0, $encoding );
	}

	/**
	 * Gets length of the given string.
	 *
	 * @since 1.0.0
	 *
	 * @param string      $string                Given string to get its length.
	 * @param string|null $encoding              (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return int string's length; 0 if empty.
	 */
	protected static function getLength( $string, $encoding = null ) {
		return is_null( $encoding ) ? strlen( $string ) : mb_strlen( $string );
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

	/**
	 * Gets a character or substring from the starting position (defaults to 0).
	 *
	 * @since 1.0.0
	 *
	 * @param string       $searchStr            String to search.
	 * @param string       $needle               The character(s) or substring(s) to find.
	 * @param integer|null $start                (Optional) Starting position to begin the search.
	 * @param string|null  $encoding             (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return string substring, if found; else an empty string.
	 */
	protected static function getSubstring( $searchStr, $needle, $start = 0, $encoding = null ) {
		$length = self::getLength( $needle, $encoding );

		// Search from the end.
		if ( -1 === $start ) {
			return $encoding
				? (string) mb_substr( $searchStr, - $length, null, $encoding )
				: (string) substr( $searchStr, - $length );
		}

		// A null starting position means to search in the middle of the search string.
		if ( is_null( $start ) ) {
			$start = self::getPos( $searchStr, $needle, 0, $encoding );
		}

		return $encoding
			? (string) mb_substr( $searchStr, $start, $length, $encoding )
			: (string) substr( $searchStr, $start, $length );
	}

	/**
	 * Checks if a given search string starts with the given character(s) or substring(s).
	 *
	 * When given array of characters and/or substrings, returns `true` on the first match.
	 *
	 * @since 1.0.0
	 *
	 * @param string               $searchStr    String to search.
	 * @param string|integer|array $charOrSubstr The character(s) or substring(s) find and compare.
	 * @param integer              $start        Starting position to begin the search.
	 * @param string|null          $encoding     (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return bool true when search string starts with the given character or substring; else false.
	 */
	public static function matches( $searchStr, $charOrSubstr, $start, $encoding = null ) {
		if ( ! is_string( $searchStr ) || '' === $searchStr ) {
			return false;
		}

		if ( ! is_array( $charOrSubstr ) ) {
			return self::getSubstring( $searchStr, $charOrSubstr, $start, $encoding ) === (string) $charOrSubstr;
		}

		foreach ( $charOrSubstr as $needle ) {
			if ( '' === $needle ) {
				continue;
			}

			if ( self::getSubstring( $searchStr, $needle, $start, $encoding ) === (string) $needle ) {
				return true;
			}
		}

		return false;
	}
}
