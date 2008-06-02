<?php

/**
 * RadioButton.class.php
 *
 * This is the class that implements a radio button field.
 */

class RadioButton extends Field {
	
 	
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
	
 	
 	/** the options the field contains */
 	private $options;
 	
 	
 	
 	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
 	
	
 	public function get_options() { return $this->options; }
 	
 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function RadioButton($name, $caption, $css = "") {
		
		$this->Field($name, $caption, $css);
		
	} // # END RadioButton
	
	
	
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
	public function add_option(RadioOption $option) {
		
	 	$flag = true;
	 	
	 	for ($i = 1; $flag == true; $i++) {
	 		
			if (!isset($this->options[$i])) {
				
				$this->options[$i] = $option;
				$flag = false;
			}
			
		}
		
	} // # END add_option
	
	
	
	
	/**
	 * Returns the html code to show the radio button field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a radio button field.
	 */
	public function get_display($value) {
		
	 	$count_options = count($this->options);
	 	$replacement = "";
	 	
		 for ($i = 1; $i <= $count_options; $i++) {
		 	
	   		if (!$value[0]) {

	   			if ($this->options[$i]->get_selected() == true) {
					$var = " checked=\"checked\"";
				}
			}
			else {

				if ($value[0][$this->name] == $this->options[$i]->get_value()) {
					$var = " checked=\"checked\"";
				}
			}
			
			if ($this->options[$i]->get_caption_pos() == "left") {

				$caption_left = "<span".$this->options[$i]->get_caption_css().">".$this->options[$i]->get_caption()."</span>";
			}
			else {
				
				$caption_right = "<span".$this->options[$i]->get_caption_css().">".$this->options[$i]->get_caption()."</span>";
			}
			
		    $replacement .= "".$caption_left." <input type=\"radio\" name=\"".$this->name."\" value=\"".$this->options[$i]->get_value()."\"".$this->options[$i]->get_css()."".$var." /> ".$caption_right."\n";
		    unset ($var, $caption_left, $caption_right);
		
		 }
					
		return $replacement;
		
	} // # END get_display
	
}

?>