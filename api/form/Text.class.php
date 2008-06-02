<?php

// FIXME: Wozu diese Klasse??

/**
 * Text.class.php
 *
 * This is the class that implements a normal text.
 */

class Text extends Field {
	
 	
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function Text($name, $value) {
		
		$this->name = $name; 
		$this->value = $value;
	
	} // # END Text
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the text.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a text.
	 */
	public function get_display($value) {
			
		if ($value[0] == "") {
			
			$value[0] = $this->value;
		}
	
		return "".$value[0]."";
	
	} // # END get_display
	
}

?>