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
		if ( ! is_string( $searchStr ) || '' === $searchStr || empty( $charOrSubstr ) ) {
			return false;
		}

		if ( ! is_array( $charOrSubstr ) ) {
			return self::matches( $searchStr, $charOrSubstr, null, $encoding );
		}

		foreach ( $charOrSubstr as $needle ) {
			if ( '' === $needle ) {
				continue;
			}

			if ( self::matches( $searchStr, $needle, null, $encoding ) ) {
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
	public static function startsWith( $searchStr, $charOrSubstr, $encoding = null ) {
		if ( ! is_string( $searchStr ) || '' === $searchStr || empty( $charOrSubstr ) ) {
			return false;
		}

		if ( ! is_array( $charOrSubstr ) ) {
			return self::matches( $searchStr, $charOrSubstr, 0, $encoding );
		}

		foreach ( $charOrSubstr as $needle ) {
			if ( '' === $needle ) {
				continue;
			}

			if ( self::matches( $searchStr, $needle, 0, $encoding ) ) {
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

	/**
	 * Gets a character or substring from the starting position (defaults to 0).
	 *
	 * @since 1.0.0
	 *
	 * @param string      $searchStr             String to search.
	 * @param integer     $start                 (Optional) Starting position to begin the search.
	 * @param string      $charOrSubstr          The character or substring. Used to get the length to fetch.
	 * @param string|null $encoding              (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return string substring, if found; else an empty string.
	 */
	protected static function getSubstring( $searchStr, $charOrSubstr, $start = 0, $encoding = null ) {
		if ( $encoding ) {
			return is_null( $start )
				? (string) mb_substr( $searchStr, -mb_strlen( $charOrSubstr ), null, $encoding )
				: (string) mb_substr( $searchStr, $start, mb_strlen( $charOrSubstr ), $encoding );
		}

		return is_null( $start )
			? (string) substr( $searchStr, -mb_strlen( $charOrSubstr ) )
			: (string) substr( $searchStr, $start, strlen( $charOrSubstr ) );
	}

	/**
	 * Checks if a given search string at the given starting position matches with the given character(s) or
	 * substring(s).
	 *
	 * @since 1.0.0
	 *
	 * @param string      $searchStr             String to search.
	 * @param integer     $start                 (Optional) Starting position to begin the search.
	 * @param string      $charOrSubstr          The character or substring. Used to get the length to fetch.
	 * @param string|null $encoding              (Optional) Character encoding. When given, uses multi-byte safe
	 *                                           operation. Default: null.
	 *
	 * @return bool true if it matches; else false.
	 */
	protected static function matches( $searchStr, $charOrSubstr, $start = 0, $encoding = null ) {
		return self::getSubstring( $searchStr, $charOrSubstr, $start, $encoding ) === (string) $charOrSubstr;
	}
}
