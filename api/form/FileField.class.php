<?php

/**
 * FileField.class.php
 *
 * This is the class that implements a file field with which the user can
 * upload files.
 */

class FileField extends Field {
	
	 
 	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
	
 	
 	/**
 	 * upload pictures or other data ("image", "data")
 	 * if set to image some checks will be made
 	 */
 	private $data_type;
 	
 	/**
	 * dir into that the uploaded data will be saved
	 * (example: "images/")
	 */
 	private $file_dir;
 	
 	/**
 	 * array (example: 1 => "image/pjpeg", 2 => "image/gif")
 	 * if nothing is defined all types will be allowed!
 	 */
 	private $file_types;
 	
 	/**
 	 * array ("x" => [int], "y" => [int], "check" => "smaller"/"bigger"/"same"/"up_to")
 	 * - only use if only image file types are allowed and "data_type" is set to "image"
 	 */
 	private $image_dimensions;
 	
 	
 	
	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
 	
 	
	public function get_data_type()				{ return $this->data_type;			}
 	public function get_file_dir()				{ return $this->file_dir;			}
 	public function get_file_types()			{ return $this->file_types;			}
 	public function get_image_dimensions()		{ return $this->image_dimensions;	}
 	
 	
 	
 	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */
	
 	
	public function FileField(
					$name,
					$caption,
					$data_type,
					$file_dir,
					$file_types,
					$css = "",
					$image_dimensions = "") {

						
		$this->Field($name, $caption, $css);
		
		$this->data_type		 = $data_type;
		$this->file_dir			 = $file_dir;
		$this->file_types		 = $file_types;
		$this->image_dimensions	 = $image_dimensions;
		
	} // # END FileField
	
	
	
	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	
	
	/**
	 * Returns the html code to show the file field.
	 *
	 * @param	$value
	 * 			As explained in the prototype of the base class.
	 * 
	 * @return	html code to display a file field.
	 */
	public function get_display($value) {
		
		return "<input type=\"file\" name=\"".$this->name."\"".$this->css." />";
	
	} // # END get_display
	
}

?>