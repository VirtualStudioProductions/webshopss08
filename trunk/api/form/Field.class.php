<?php

/**
 * Field.class.php
 *
 * This is the base class for all form fields.
 */

abstract class Field {
	

	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */

	
	/** name of the field which is used to refer to it */
	protected $name;

	/** caption of the field (this is only used for error messages) */
	protected $caption;

	/** css that will be added (like class=\"\") */
	protected $css;

	/** data will only be processed if this is set to true
	 * (default is: true)
	 */
	protected $process_field;


	
	/** VALIDATORS */
	/** ---------------------------------- */

	/** true = this field musnt' be empty */
	protected $v_required;

	/** true = this field has to be an email adress ('@', '.', minlength: 5) */
	protected $v_email;

	/** true = this field has to be a link (min 1x '.', minlength: 3) */
	protected $v_link;

	/** true = this field has to be a numeric value */
	protected $v_numeric;

	/** [int] defines the maximum length of the value (endless if zero) */
	protected $v_maxlength;

	/** [int] defines the minimum length of the value (endless if zero) */
	protected $v_minlength;

	/** true = only lowercase chars are allowed */
	protected $v_onlylowercase;

	/** true = no spaces between, before or after chars are allowed */
	protected $v_nospace;

	/** [int] defines the maximum value the field may be (endless if zero) */
	protected $v_maxvalue;

	/** [int] defines the minimum value the field may be (endless if zero) */
	protected $v_minvalue;

	/** true = unique db entry */
	protected $v_isunique;

	/** [string] name of the field this field should confirm */
	protected $v_confirms;

	/** true = no special chars allowed */
	protected $v_nospecial;

	/** true = $ ' and " not allowed */
	protected $v_nosql;

	/** only the values in this array are allowed */
	protected $v_allowed;

	/** only read allowed */
	protected $v_readonly;

	/** TODO: ?????? */
	protected $v_dir;

	/** TODO: ???? only read allowed */
	protected $f_value = "";

	/** TODO: ??? javascript */
	protected $actions;

	/** TODO: show a picture? (???) */
	protected $v_show_image;
	
	
	
	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */
	
	
	public function get_name()					{ return $this->name;			}
	public function get_caption()				{ return $this->caption;		}
	public function get_css()					{ return $this->css;			}
	public function get_process_field()			{ return $this->process_field;	}
	public function get_actions()				{ return $this->actions;		}
	public function get_f_value()				{ return $this->f_value;		}

	// TODO: ??????
	public function set_value($value)			{ $this->f_value		= $value;	}
	public function set_process_field($value)	{ $this->process_field	= $value;	}
	
	// Setters for the validators
	public function set_v_required($set)		{ $this->v_required 	 = $set; }
	public function set_v_email($set)			{ $this->v_email		 = $set; }
	public function set_v_link($set)			{ $this->v_link			 = $set; }
	public function set_v_numeric($set)			{ $this->v_numeric		 = $set; }
	public function set_v_maxlength($set)		{ $this->v_maxlength	 = $set; }
	public function set_v_minlength($set)		{ $this->v_minlength	 = $set; }
	public function set_v_onlylowercase($set)	{ $this->v_onlylowercase = $set; }
	public function set_v_nospace($set)			{ $this->v_nospace		 = $set; }
	public function set_v_maxvalue($set)		{ $this->v_maxvalue		 = $set; }
	public function set_v_minvalue($set)		{ $this->v_minvalue		 = $set; }
	public function set_v_isunique($set)		{ $this->v_isunique		 = $set; }
	public function set_v_confirms($set)		{ $this->v_confirms		 = $set; }
	public function set_v_nospecial($set)		{ $this->v_nospecial	 = $set; }
	public function set_v_nosql($set)			{ $this->v_nosql		 = $set; }
	public function set_v_allowed($set)			{ $this->v_allowed		 = $set; }
	public function set_v_readonly($set)		{ $this->v_readonly		 = $set; }
	public function set_v_dir($set)				{ $this->v_dir			 = $set; }
	public function set_v_show_image($set)		{ $this->v_show_image 	 = $set; }

	// Getters for the validators
	public function get_v_required()			{ return $this->v_required;			}
	public function get_v_email()				{ return $this->v_email;			}
	public function get_v_link()				{ return $this->v_link;				}
	public function get_v_numeric()				{ return $this->v_numeric;			}
	public function get_v_maxlength()			{ return $this->v_maxlength;		}
	public function get_v_minlength()			{ return $this->v_minlength;		}
	public function get_v_onlylowercase()		{ return $this->v_onlylowercase;	}
	public function get_v_nospace()				{ return $this->v_nospace;			}
	public function get_v_maxvalue()			{ return $this->v_maxvalue;			}
	public function get_v_minvalue()			{ return $this->v_minvalue;			}
	public function get_v_isunique()			{ return $this->v_isunique;			}
	public function get_v_confirms()			{ return $this->v_confirms;			}
	public function get_v_nospecial()			{ return $this->v_nospecial;		}
	public function get_v_nosql()				{ return $this->v_nosql;			}
	public function get_v_allowed()				{ return $this->v_allowed;			}
	// TODO: ???????
	public function get_v_readonly()			{ if($this->v_readonly) { return "readonly"; } else { return ""; } }
	public function get_v_dir()					{ return $this->v_dir;				}
	public function get_v_show_image()			{ return $this->v_show_image;		}


	
	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */

	
	public function Field($name, $caption, $css) {
		
		$this->name					 = $name;
		$this->caption				 = $caption;
		$this->css					 = $css;
		$this->process_field		 = true;

		// validators
		$this->v_required			 = false;
		$this->v_email				 = false;
		$this->v_link				 = false;
		$this->v_numeric			 = false;
		$this->v_maxlength			 = 0;
		$this->v_minlength			 = 0;
		$this->v_onlylowercase		 = false;
		$this->v_nospace			 = false;
		$this->v_maxvalue			 = 0;
		$this->v_minvalue			 = 0;
		$this->v_isunique			 = false;
		$this->v_confirms			 = "";
		$this->v_nospecial			 = false;
		$this->v_nosql				 = true;
		$this->v_allowed			 = "";
		$this->v_show_image			 = false;
		
	} // # END Field



	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */
	

	/**
	 * This is an abstract function every derivative class needs to
	 * implement.
	 * It must return the html code to display the field.
	 *
	 * @param	$value
	 * 			This is the value the field shows. You will later use this
	 *			parameter to give the field back what the user typed into
	 *			it if there were any errors while processing the form. So
	 *			that the user doesn't need to type everything again.
	 */
	public abstract function get_display($value);

	
	
	
	// TODO: ????????
	public function add_action(Action $action){ $this->actions .= $action->get_actions(); }

}



// I just require all the derivated classes right here so that it won't
// disturb in the core code
require_once("FileField.class.php");
require_once("HiddenField.class.php");
require_once("PasswordField.class.php");
require_once("RadioButton.class.php");
require_once("SelectField.class.php");
require_once("TextArea.class.php");
require_once("TextField.class.php");
require_once("CheckBox.class.php");
require_once("Option.class.php");
require_once("Action.class.php");
require_once("Text.class.php");

?>