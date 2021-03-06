<?php
/**
 * FilterIterator
 */
namespace Sledgehammer;
/**
 * Extend an Iterator with 1 or more filters
 *
 * @package Filters
 */
class FilterIterator extends Object implements \Iterator {

	/**
	 * @var Iterator
	 */
	private $iterator;

	/**
	 * @var array|callable
	 */
	private $filters;

	/**
	 * @var bool
	 */
	private $perColumn;

	/**
	 * @param Iterator $iterator an Iterator object
	 * @param Filter|array $filters A Filter or a Filter per column: array('column1' => new FunctionFilter('md5'))
	 */
	function __construct($iterator, $filters) {
		if ($iterator instanceof \Iterator) {
			$this->iterator = $iterator;
		} else {
			$type = (gettype($iterator) == 'object') ? get_class($iterator) : gettype($iterator);
			throw new \Exception('$Iterator('.$type.') doesn\'t implement Iterator');
		}
		$this->filters = $filters;
		$this->perColumn = is_array($this->filters);
	}

	function current() {
		$values = $this->iterator->current();
		if ($this->perColumn) {
			foreach ($this->filters as $key => $filter) {
				$values[$key] = filter($values[$key], $filter);
			}
			return $values;
		} else {
			return filter($values, $this->filters);
		}
	}

	function next() {
		return $this->iterator->next();
	}

	function key() {
		return $this->iterator->key();
	}

	function valid() {
		return $this->iterator->valid();
	}

	function rewind() {
		return $this->iterator->rewind();
	}

}

?>
