<?php
/**
 * FilterObjectTests
 *
 */
namespace SledgeHammer;

class FilterWrapperTests extends TestCase {

	function test_() {
		restore_error_handler();
		$array = array(
			'vera' => 'aloë',
			'js' => '<script>alert("hacked");</script>',
		);
		$filtered = new FilterWrapper($array, array('filter' => new HtmlFilter()));
		$this->assertEqual($filtered['vera'], 'alo&euml;');

	}

}

?>
