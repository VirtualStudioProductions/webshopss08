<?php

/**
 * TextField.class.php
 *
 * This is the class that implements a normal text field.
 */

class TextField extends Field {
	
 	
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 	
	
 	/** maximum chars the user may type */
 	private $maxlength;
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
 	
	public function TextField($name, $caption, $css = "", $maxlength = 50) {
		
		$this->Field($name, $caption, $css);
		
		$this->maxlength = $maxlength;
	
	} // # END TextField
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the text field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a text field.
	 */
	public function get_display($value) {
			
		$FIELD = $value[1];
		
		return "<input type=\"text\" name=\"".$this->name."\" value=\"".$value[0]."\" maxlength=\"".$this->maxlength."\"".$this->css." dir=\"".$FIELD->get_v_dir()."\" ".$FIELD->get_actions().$FIELD->get_v_readonly()." />";
	
	} // # END get_display
	
}

?>