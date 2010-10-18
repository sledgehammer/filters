<?php
/**
 * @package Filters
 */

/**
 * Shortcut to use a Filter object.
 *   $Filter = new FilterClass;
 *   $filtered_value = $Filter->filter($value);
 * Becomes
 *   $filtered_value = filter($value, new FilterClass);
 *
 * @param mixed $value Input for the Filter
 * @param Filter $Filter a Filter object
 * @return mixed filtered output
 */
function filter($value, $Filter) {
	return $Filter->filter($value);
}
?>
