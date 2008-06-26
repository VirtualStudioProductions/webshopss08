<?php

/**
 * PasswordField.class.php
 *
 * This is the class that implements a password field.
 */

class PasswordField extends Field {
	
 	
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
	
 	
 	/** maximum chars the user may type */
 	private $maxlength;
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
 	
	
	public function PasswordField($name, $caption, $css = "", $maxlength = 50) {
		
		$this->Field($name, $caption, $css);
		
		$this->maxlength = $maxlength;
	
	} // # END PasswordField
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the password field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a password field.
	 */
	public function get_display($value) {
		
		return "<input type=\"password\" id=\"".$this->name."\" name=\"".$this->name."\" value=\"".htmlspecialchars($value[0])."\" maxlength=\"".$this->maxlength."\"".$this->css." />";
	
	} // # END get_display
	
}

?>