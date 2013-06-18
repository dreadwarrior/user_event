<?php
class user_events_Utility_GeneralUtility {

	/**
	 * Converts string to uppercase
	 * The function converts all Latin characters (a-z, but no accents, etc) to
	 * uppercase. It is safe for all supported character sets (incl. utf-8).
	 * Unlike strtoupper() it does not honour the locale.
	 *
	 * @param string $str Input string
	 * @return string Uppercase String
	 */
	static public function strtoupper($str) {
		return strtr((string) $str, 'abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
	}

	/**
	 * Converts string to lowercase
	 * The function converts all Latin characters (A-Z, but no accents, etc) to
	 * lowercase. It is safe for all supported character sets (incl. utf-8).
	 * Unlike strtolower() it does not honour the locale.
	 *
	 * @param string $str Input string
	 * @return string Lowercase String
	 */
	static public function strtolower($str) {
		return strtr((string) $str, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');
	}

	/**
	 * Converts the first char of a string to lowercase if it is a latin character (A-Z).
	 * Example: Converts "Hello World" to "hello World"
	 *
	 * @param string $string The string to be used to lowercase the first character
	 * @return string The string with the first character as lowercase
	 */
	static public function lcfirst($string) {
		return self::strtolower(substr($string, 0, 1)) . substr($string, 1);
	}

	/**
	 * Returns a given string with underscores as UpperCamelCase.
	 * Example: Converts blog_example to BlogExample
	 *
	 * @param string $string String to be converted to camel case
	 * @return string UpperCamelCasedWord
	 */
	static public function underscoredToUpperCamelCase($string) {
		$upperCamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', self::strtolower($string))));
		return $upperCamelCase;
	}

	/**
	 * Returns a given string with underscores as lowerCamelCase.
	 * Example: Converts minimal_value to minimalValue
	 *
	 * @param string $string String to be converted to camel case
	 * @return string lowerCamelCasedWord
	 */
	static public function underscoredToLowerCamelCase($string) {
		$upperCamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', self::strtolower($string))));
		$lowerCamelCase = self::lcfirst($upperCamelCase);
		return $lowerCamelCase;
	}

	/**
	 * Returns a given CamelCasedString as an lowercase string with underscores.
	 * Example: Converts BlogExample to blog_example, and minimalValue to minimal_value
	 *
	 * @param string $string String to be converted to lowercase underscore
	 * @return string lowercase_and_underscored_string
	 */
	static public function camelCaseToLowerCaseUnderscored($string) {
		return self::strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
	}
}
?>