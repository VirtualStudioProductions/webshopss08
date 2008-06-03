<?php

/**
 * HiddenField.class.php
 *
 * This is the class that implements a hidden field.
 */

class HiddenField extends Field {
	
 	
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 	
	
 	// the value of the hidden field
 	private $value;
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
 	
	public function HiddenField($name, $value) {
		
		$this->Field($name, "", "");
		
		$this->value = $value;
	
	} // # END HiddenField
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the hidden field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a hidden field.
	 */
	public function get_display($value) {
		
	 	if ($value[0] == "") {
	 		$val = $this->value;
		}
		else {
			$val = $value[0];
		}

		return "<input type=\"hidden\" name=\"".$this->name."\" value=\"".$val."\" />";
	
	} // # END get_display
	
}

?>