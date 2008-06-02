<?php

/**
 * SelectOption.class.php
 *
 * This class implements a select option.
 */

class SelectOption extends Option {
	
	
	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function SelectOption($caption, $value, $selected = false) {
		
		$this->Option($caption, $value, $selected);
	
	} // # END SelectOption
	
}

?>