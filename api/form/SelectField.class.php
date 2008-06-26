<?php

/**
 * SelectField.class.php
 *
 * This is the class that implements a drop down select field.
 */

class SelectField extends Field {
	

	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 	
	
 	/** the options the field contains */
 	private $options;
 	
 	
 	
 	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
 	
 	
	public function get_options()	{ return $this->options; }
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function SelectField($name, $caption, $css = "") {
		
		$this->Field($name, $caption, $css);
	
	} // # END SelectField
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Adds an option to the field. Each key has an index with a suffix
	 * that is his number. If you add an option name it will be get
	 * the key name_1 ... if you then again add an option called name
	 * it will get the key name_2 etc.
	 *
	 * @param 	$option
	 * 			The option object that will be added.
	 */
	public function add_option(SelectOption $option) {
		
	 	$flag = true;
	 	
	 	for ($i = 1; $flag == true; $i++) {
	 		
			if (!isset($this->options[$i])) {
				
				$this->options[$i] = $option;
				$flag = false;
			}
		
	 	}
	
	} // # END add_option
	
	
	
	
	/**
	 * Returns the html code to show the drop down select field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a drop down select field.
	 */
	public function get_display($value) {
			
	 	$options = $this->options;
		$count_options = count($options);
		$FIELD = $value[1];
	 	$replacement = "<select id=\"".$this->name."\" name=\"".$this->name."\"".$this->css." ".$FIELD->get_actions().">\n";
	 	
		for ($i = 1; $i <= $count_options; $i++) {
			
	   		if (!$value[0]) {
	   			
				if ($options[$i]->get_selected() == true) {
					$var = " selected=\"selected\"";
				}
			}
			else {
				
				if ($value[0] == $options[$i]->get_value()) {
					$var = " selected=\"selected\"";
				}
			}
			
		    $replacement .= "<option value=\"".htmlspecialchars($options[$i]->get_value())."\"".$var.">".$options[$i]->get_caption()."</option>\n";
		    unset ($var);
		
		}
		
		$replacement .= "</select>\n";
					
		return $replacement;
	
	} // # END get_display
	
}

?>