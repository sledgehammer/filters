<?php
/**
 * Veranderd een willekeurige string naar een nette bestandsnaam 
 * Corrigeerd karakers zoals "o-met puntjes"naar een "o"
 *
 * @todo Conversie naar lowercase e.d. configureerbaar maken
 * @package Filters
 */

class FilenameFilter extends Object implements Filter{
	
	public
		$toLowerCase,
		$charset;
		
	function __construct($toLowerCase = true, $charset = null) {
		$this->toLowerCase = $toLowerCase;
		if ($charset === null) {
			$this->charset = $GLOBALS['charset'];
		} else {
			$this->charset = $charset;
		}
	}

	public function filter($value)	{
		$value = self::convertSpecialChars($value, $this->charset);
		
		$value = preg_replace('/[^a-z0-9\.]/i', '-', $value);
		$value = preg_replace('/[\-]{2,}/', '-', $value);
		$value = preg_replace('/[\.]{2,}/', '.', $value);
		if ($this->toLowerCase) {
			$value = strtolower($value);
		}
		$value = trim($value,'-');
		$value = rtrim($value,'.');
		return $value;
	}

	/**
	 * @param string $text line of encoded text
	 * @param string $from_enc (encoding type of $text, e.g. UTF-8, ISO-8859-1)
	 *
	 * @return 7bit representation
	 */
	static function convertSpecialChars($text, $charset) {
    	//$text = mb_convert_encoding($text,'HTML-ENTITIES',$charset);
    	$text = htmlentities($text, ENT_COMPAT, $charset).'"';
    	$text = preg_replace(
			array('/&szlig;/','/&(..)lig;/',
			'/&([aouAOU])uml;/','/&(.)[^;]*;/'),
			array('ss',"$1","$1".'e',"$1"),
			$text
		);
    	return $text;
	}  
	
	/**
	 * @author Tim Schipper
	 */
	static function convertSpecialChars2($string) {
		$string = strtr($string,
					"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñÐÝýÞßðþ",
					"AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNnDYyPbop");
		$string = str_replace(array('Æ','æ'),array('AE','ae'),$string);
		return $string;
	}
}
?>