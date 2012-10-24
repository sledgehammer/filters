<?php
/**
 * HtmlentitiesFilter
 */
namespace Sledgehammer;
/**
 * Converts raw text into htmlencoded text.
 * Protects against XSS attacks.
 *
 * @package Filters
 */
class HtmlentitiesFilter extends Object {

	/**
	 * Deze filter kijkt naar het datatype en geeft een html-safe waarde terug.
	 *
	 * @param mixed $text
	 * @return mixed xss-safe value
	 */
	function __invoke($text) {
		switch (gettype($text)) {

			case 'string':
				return htmlentities($text, ENT_COMPAT, Framework::$charset);

			case 'NULL':
			case 'boolean':
			case 'integer':
			case 'double':
				return $text; // Deze types kunnen geen xss tags bevatten.

			case 'object':
				if (method_exists($text, '__toString')) { // Kan het object omgezet worden naar een string?
					return htmlentities($text, ENT_COMPAT, Framework::$charset); // Omzet naar string en deze string escapen.
				}
				notice('Objects without __toString() implementation are not allowed');
				return null;

			default:
			case 'resource':
			case 'array':
				notice('Unacceptable type: "'.gettype($text).'"');
				return null;
		}
	}
}

?>
