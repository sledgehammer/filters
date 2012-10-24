<?php
/**
 * FilterWrapper
 */
namespace Sledgehammer;
/**
 * Wraps all properties/elements with a filter.
 *
 * @package Filters
 */
class FilterWrapper extends Wrapper {

	/**
	 * @var callable
	 */
	protected $_filter;
	/**
	 *
	 * @var callable
	 */
	protected $_inputFilter;
	/**
	 *
	 * @var callable
	 */
	protected $_outputFilter;

	function __construct($data, $options = array()) {
		parent::__construct($data, $options);
		if ($this->_filter === null) {
			throw new \Exception('option "filter" is required for a FilterWrapper');
		}
		if ($this->_inputFilter === null) {
			$this->_inputFilter = $this->_filter;
		}
		if ($this->_outputFilter === null) {
			$this->_outputFilter = $this->_filter;
		}
	}

	protected function out($value, $element, $context) {
		$value = parent::in($value, $element, $context);
		return filter($value, $this->_outputFilter);
	}

	protected function in($value, $element, $context) {
		$value = parent::in($value, $element, $context);
		return filter($value, $this->_inputFilter);
	}
}

?>
