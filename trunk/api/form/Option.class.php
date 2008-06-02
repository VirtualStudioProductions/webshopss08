<?php

/**
 * Option.class.php
 *
 * This is the base class for all options.
 */

abstract class Option {
	
	
	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
	
	
	/** value of the field if chosen */
	private $value;
	
	/** is this option selected at start? */
	private $selected;
	
	/** the label of this option */
	private $caption;
	
	
	
	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
	
	
	public function get_caption()	{ return $this->caption;	}
	public function get_selected()	{ return $this->selected;	}
	public function get_value()		{ return $this->value;		}
	
	
	
	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function Option($caption, $value, $selected) {
		
	 	$this->caption		= $caption;
		$this->value		= $value;
		$this->selected		= $selected;
	
	} // # END Option
	
}


// I just require all the derivated classes right here so that it won't
// disturb in the core code
require_once("RadioOption.class.php");
require_once("SelectOption.class.php");

?>