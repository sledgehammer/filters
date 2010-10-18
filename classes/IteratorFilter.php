<?php
/**
 * Extend an Iterator with 1 or more Filter objects
 * 
 * @package Filters
 */

class IteratorFilter extends Object implements Iterator {

	private 
		$Iterator,
		$Filters,
		$filter_per_column; // bool

	/**
	 *
	 * @param Iterator $Iterator an Iterator object
	 * @param Filter|array $Filters A Filter or a Filter per column: array('column1' => new FunctionFilter('md5'))
	 */
	function __construct($Iterator, $Filters) {
		if ($Iterator instanceof Iterator) {
			$this->Iterator = $Iterator;
		} else {
			$type = (gettype($Iterator) == 'object') ? get_class($Iterator) : gettype($Iterator);
			throw new Exception('$Iterator('.$type.') doesn\'t implement Iterator');
		}
		$this->Filters = $Filters;
		$this->filter_per_column = is_array($this->Filters);
	}

	function current() {
		$values = $this->Iterator->current();
		if ($this->filter_per_column) {
			foreach ($this->Filters as $key => $Filter) {
				$values[$key] = $Filter->filter($values[$key]);
			}
			return $values;
		} else {
			return $this->Filters->filter($values);
		}
	}
	function next() {
		return $this->Iterator->next();
	}
	function key() {
		return $this->Iterator->key();
	}
	function valid() {
		return $this->Iterator->valid();
	}
	function rewind() {
		return $this->Iterator->rewind();
	}
}
?>
