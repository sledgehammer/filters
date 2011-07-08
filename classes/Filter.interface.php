<?php
/**
 * De interface definitie van voor Filter objecten
 *
 * @package Filters
 */
namespace SledgeHammer;
interface Filter {

	/**
	 * This function uses $value as input and returns the filtered output
	 *
	 * @param mixed $value
	 * @return filtered version of $value
	 */
	function filter($value);
}
?>
