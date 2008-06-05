<?php

/**
 * CheckBox.class.php
 *
 * This is the class that implements a check box.
 */

class CheckBox extends Field {
	
 
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 	
	
 	/** is this field checked at start? */
 	private $selected;
 	
 	/** value of the field if chosen */
 	private $value;
 	
 	
 	
 	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
 	
 	
	public function get_selected()	{ return $this->selected;	}
 	public function get_value()		{ return $this->value;		}
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
 	
	public function CheckBox($name, $caption, $value, $selected = false, $css = "") {
		
		$this->Field($name, $caption, $css);
		
		$this->selected = $selected;
		$this->value 	= $value;
		
	} // # END CheckBox
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the check box.
	 *
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a check box.
	 */
	public function get_display($value) {
		
	   	if (!$value[0]) {
			
	   		if ($this->selected == true) {
				$checked = " checked=\"checked\"";
			}
		
	   	}
		else {

			if ($value[0] == $this->value) {
				$checked = " checked=\"checked\"";
			}
			
		}
					
		return "<input type=\"checkbox\" id=\"".$this->name."\" name=\"".$this->name."\" value=\"".$this->value."\"".$this->css."".$checked." />\n";;
	
	} // # END get_display
	
}

?>