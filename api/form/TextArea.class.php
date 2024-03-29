<?php

/**
 * TextArea.class.php
 *
 * This is the class that implements a text area.
 */

class TextArea extends Field {
	
 
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 	
	
 	/** rows of the text area */
 	private $rows;
 	
 	/** columns of the text area */
 	private $cols;
 	
 	 	
 
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
 	
	public function TextArea($name, $caption, $css = "", $rows = 4, $cols = 20) {
		
		$this->Field($name, $caption, $css);
		
		$this->rows		 = $rows;
		$this->cols		 = $cols;
	
	} // # END TextArea
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the text area field.
	 * 
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a text area field.
	 */
	public function get_display($value) {
			
		$FIELD = $value[1];

		return "<textarea id=\"".$this->name."\" name=\"".$this->name."\" rows=\"".$this->rows."\" cols=\"".$this->cols."\" ".$this->css." ".$FIELD->get_actions().">".htmlspecialchars($value[0])."</textarea>";
	
	} // # END get_display
	
}

?>