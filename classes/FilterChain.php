<?php
/**
 * FilterChain
 */
namespace Sledgehammer;
/**
 * A filter that filters a variable through multiple filters, but acts as a single filter.
 * @package Filters
 */
class FilterChain extends Object {

	/**
	 * Array containing the filters in order.
	 * @var array
	 */
	private $filters;

	/**
	 * Constructor
	 * @param array $filters
	 */
	function __construct($filters) {
		if (count($filters) < 2) {
			notice('A FilterChain should contain at least 2 filters');
		}
		$this->filters = $filters;
	}

	function __invoke($value) {
		foreach ($this->filters as $filter) {
			$value = filter($value, $filter);
		}
		return $value;
	}

}

?>
