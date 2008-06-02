<?php

/**
 * RadioOption.class.php
 *
 * This class implements a radio button option.
 */

class RadioOption extends Option {
	
 
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
 
	
 	/** css that will be added (like class=\"\") */
	private $css;
	
	/** position of the label ("left" or "right") */
	private $caption_pos;
	
	/** css for the caption */
	private $caption_css;
	
	
	
	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
	
	
	public function get_css()			{ return $this->css;			}
	public function get_caption_pos()	{ return $this->caption_pos;	}
	public function get_caption_css()	{ return $this->caption_css;	}
	
	
	
	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
	
	public function RadioOption(
					$caption,
					$value,
					$selected = false,
					$caption_pos = "left",
					$caption_css = "",
					$css = "") {
			
		$this->Option($caption, $value, $selected);
		
		$this->css			= $css;
		$this->caption_pos	= $caption_pos;
		$this->caption_css	= $caption_css;

	} // # END RadioOption
	
}

?>