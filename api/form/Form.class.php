<?php

/**
 * Form.class.php
 * 
 * 22.04.2008 - VERSION 5 featuring
 * 
 * 		- PDO
 * 		- JAVASCRIPT SUPPORT
 * 		- JAVADOC DOCUMENTATION
 *
 * The description of the fields can be found in the Field.class.php and its children!
 */

class Form {
	

	/**
	 * THE FORM CLASS
	 * comment:					powerful class for form processing
	 * author:					Alexander Weickmann <Alexander.Weickmann@gmx.de> (Eistoeter)
	 * release date:			14.06.2008
	 * start of the project:	29.11.2005
	 * version:					5.3
	 * requirement:				scripted for php5.1 and mysql
	 * description:				this class was coded only to simplify data-processing coming
	 *                          from standard forms (for example guestbooks, newsscripts,
	 *                          forums, simple dynamic text fields etc.) so you don't have
	 *                          to code every new simple form and it's processing functions
	 *                          anew which is often the most work when programming a website.
	 *                          with some skill even more complicated forms should be possible
	 */



	/** **************** */
	/** CLASS ATTRIBUTES */
	/** **************** */
	
	
	/** enum for the error levels */
	const ERROR_FATAL = 1;
	const ERROR_NORMAL = 2;
	const ERROR_WARNING = 3;
	
	/** path to the layout files */
	private $layout_dir;
	
	/** the fields of the form */
	private $fields;

	/**
	 * array that contains all different names the form contains
	 * (without the _number suffix)
	 */
	private $namelist;

	/** colors for the error messages */
	private $error_color;
	private $warning_color;
	private $fatal_color;


	
	/** GENERAL */
	/** ---------------------------------- */

	/** name of the form used for the submit button [s_"name"] */
	private $form_name;

	/** the layout (template) for the form (required!) */
	private $layout;

	/** maximum file size in bytes (default: 25000) */
	private $MAX_FILE_SIZE;

	/** needed for forms that upload files */
	private $enctype;

	/**
	 * link the form sends the user to
	 * (default: "$_SERVER["PHP_SELF"]")
	 */
	private $action;

	/** method (default: "post") */
	private $method;

	/** show reset button? (default: true) */
	private $show_reset_button;

	/** show submit button? (default: true) */
	private $show_submit_button;

	/** show form end? (default: true) */
	private $show_form_end;

	/** caption of the submit button (default: "Abschicken!") */
	private $submit_value;

	/** caption of the reset button (default: "Rückgängig!") */
	private $reset_value;

	/** css of the form */
	private $css;

	/** css of the reset button */
	private $reset_css;

	/** css of the submit button */
	private $submit_css;

	/** redirect after successful form processing? */
	private $redirect;

	/** additional get parameters for the redirection */
	private $redirect_url;
	
	/** display a confirmation on success? */
	private $confirmation_on_success;
	
	/** the message to be displayed on success */
	private $confirmation_on_success_msg;
	
	/**
	 * the page will be automatically scrolled to the form
	 * if this is set to true
	 */
	private $jump_to_anchor;

	/**
	 * if this is "session" the values for the fields will be loaded from $_SESSION
	 * else from $_POST. This only works for a form that is intended as insert
	 * ("where" attribute not set)
	 */
	private $retrieve_data;

	/**
	 * may be "replacement" or "extention". defines if the standard process_form
	 * method will be overwritten or extended
	 */
	private $custom_type;

	/**
	 * the object to which the form belongs (must implement a process_form method
	 * if the $custom_type is set to replacement or extention)
	 */
	private $OWNER_OBJECT;

	/** the pdo object */
	private $PDO_DATA_ACCESS;
	
	/** The field that is focused from the beginning */
	private $focus_field;


	/** MySQL */
	/** ---------------------------------- */

	/** name of the mysql-table the form is linked with */
	private $sql_tblname;

	/**
	 * WHERE-Tag of the sql command
	 * if the where attribute is set the form will be an entry edit mask
	 */
	private $sql_where;

	/** name of the id */
	private $sql_id;

	/** the INSERT ID of DATEBASE */
	private $sql_insert_id;

	
	
	/** ******************* */
	/** SETTERS AND GETTERS */
	/** ******************* */

	/** To interact with the form object from the outside */

	
	public function set_error_color($color)						{ $this->error_color						= $color; }
	public function set_warning_color($color)					{ $this->warning_color						= $color; }
	public function set_fatal_color($color)						{ $this->fatal_color						= $color; }

	public function set_MAX_FILE_SIZE($size)					{ $this->MAX_FILE_SIZE						= $size; }
	public function set_action($action)							{ $this->action								= $action; }
	public function set_method($method)							{ $this->method								= $method; }
	public function set_show_reset_button($set)					{ $this->show_reset_button					= $set; }
	public function set_show_submit_button($set)				{ $this->show_submit_button					= $set; }
	public function set_show_form_end($set)						{ $this->show_form_end						= $set; }
	public function set_submit_value($value)					{ $this->submit_value						= $value; }
	public function set_reset_value($value)						{ $this->reset_value						= $value; }
	public function set_css($css)								{ $this->css								= $css; }
	public function set_reset_css($css)							{ $this->reset_css							= $css; }
	public function set_submit_css($css)						{ $this->submit_css							= $css; }
	public function set_redirect($set)							{ $this->redirect							= $set; }
	public function set_focus_field($set)						{ $this->focus_field						= $set; }
	public function set_redirect_url($set)						{ $this->redirect_url						= $set; }
	public function set_confirmation_on_success($set)			{ $this->confirmation_on_success			= $set; }
	public function set_confirmation_on_success_msg($msg)		{ $this->confirmation_on_success_msg		= $msg; }
	public function set_jump_to_anchor($set)					{ $this->jump_to_anchor						= $set; }
	public function set_retrieve_data($method)					{ $this->retrieve_data						= $method; }
	public function set_lay_folder($lay_folder)					{ $this->layout								= $this->layout_dir . $lay_folder . "/" .$this->form_name . ".lay.tpl"; }

	public function get_form_name()								{ return $this->form_name;	}
	public function get_sql_insert_id()							{ return $this->sql_insert_id; }
	public function get_redirect_url()							{ return $this->redirect_url;	}



	/** ***************** */
	/** CLASS CONSTRUCTOR */
	/** ***************** */

	
	public function Form(
					$form_name,
					$layout_dir,
					$namelist,
					$sql_tblname,
					$sql_where,
					$mysql_id_name,
					$custom_type,
					$OWNER_OBJECT,
					PDO $PDO_DATA_ACCESS) {
						
						
		$this->namelist					= $namelist;
		$this->error_color				= "#00BBBB";
		$this->warning_color			= "#00BB00";
		$this->fatal_color				= "#BB0000";

		// general
		$this->form_name					= $form_name;
		$this->layout_dir					= $layout_dir;
		$this->layout						= "".$this->layout_dir."".$this->form_name.".lay.tpl";
		$this->MAX_FILE_SIZE				= 25600;
		$this->enctype						= "";
		$this->action						= $_SERVER["PHP_SELF"] . "?" . $_SERVER["argv"][0];
		$this->method						= "post";
		$this->show_reset_button			= true;
		$this->show_submit_button			= true;
		$this->show_form_end				= true;
		$this->submit_value					= "Abschicken!";
		$this->reset_value					= "Rückgängig!";
		$this->css							= "";
		$this->reset_css					= "";
		$this->submit_css					= "";
		$this->redirect						= true;
		$this->redirect_url					= "";
		$this->confirmation_on_success		= false;
		$this->confirmation_on_success_msg	= "Vorgang war erfolgreich!";
		$this->jump_to_anchor				= true;
		$this->retrieve_data				= "post";
		$this->custom_type					= $custom_type;
		$this->OWNER_OBJECT					= $OWNER_OBJECT;
		$this->PDO_DATA_ACCESS				= $PDO_DATA_ACCESS;

		// mysql
		$this->sql_tblname					= $sql_tblname;
		$this->sql_where					= $sql_where;
		$this->sql_id						= $mysql_id_name;
		
	} // # END Form



	/** *************** */
	/** CLASS FUNCTIONS */
	/** *************** */

	
	/**
	 * Shows a form error message.
	 * 
	 * @param	$msg
	 * 			The text to be displayed
	 * 
	 * @param	$errlevel
	 * 			Can be ERROR_FATAL, ERROR_NORMAL or ERROR_WARNING
	 * 			Determines in which color the message will be displayed
	 * 
	 * @param 	$return
	 * 			if set to true the function won't print the msg but return it
	 */
	private function show_error($msg, $errlevel, $return) {
		
		// assign the right error color depending on the $errlevel
		switch ($errlevel) {
			
			case self::ERROR_FATAL:
				
				$background_color = $this->fatal_color;
				break;
			
			case self::ERROR_NORMAL:
				
				$background_color = $this->error_color;
				break;
				
			case self::ERROR_WARNING:
				
				$background_color = $this->warning_color;
				break;
				
			default:
				
				$background_color = $this->fatal_color;
				break;
			
		}
		
		
		$debug_msg = "<p style=\"color: #fff; background-color: ".$background_color.";
		 										 padding: 3px; border: 1px solid #000000;\">
						  <strong>Form Builder Error Message: ".$msg."!</strong></p>\n";

		
		if ($return != true) {
			print $debug_msg;
		} else {
			return $debug_msg;
		}
		
	} // # END show_error



	/**
	 * Adds a field to the form. Each key has an index with a suffix
	 * that is his number. If you add a field name it will be get
	 * the key name_1 ... if you then again add a field called name
	 * it will get the key name_2 etc.
	 * 
	 * @param	$field
	 * 			The field object that will be added
	 */
	public function add_field(Field $field)	{
		
		$name = $field->get_name();
		$flag = true;
		for ($i = 1; $flag == true; $i++)
		{
			if (!isset($fields["".$name."_".$i.""]))
			{
				$this->fields["".$name."_".$i.""] = $field;
				$flag = false;
				// assign enctype if a file field is added
				if (get_class($field) == "FileField") {
					if ($this->enctype != " enctype=\"multipart/form-data\"") {
						$this->enctype = " enctype=\"multipart/form-data\"";
					}
				}
			}
		}
		
	} // # END add_field



	/**
	 * Will display the form to the user. How this is done is defined
	 * in the forms layout file.
	 *
	 * @param 	msg
	 * 			If an error occured while processing the form the
	 * 			string contained in $msg["error"] will be displayed
	 */
	public function display($msg) {
		
		// only do it if there are any fields in the form
		if (count($this->fields) > 0) {

			// count how many different names the form contains
			$count_namelist = count($this->namelist);

			// get mysql data
			if ($this->sql_where != "") {

				if (!$_POST["s_".$this->form["name"].""]) {
					
					$sql = "SELECT * FROM `".$this->sql_tblname."` ".$this->sql_where."";
					$select = $this->PDO_DATA_ACCESS->query($sql);
					$res = $select->fetch();

				}
				else {

					$res = $_POST;
					$res["".$this->sql_id.""] = $_POST["id"];

				}
					
			}
			else {

				if ($this->retrieve_data == "session") {
					$res = $_SESSION;
				} else {
					$res = $_POST;
				}
					
			}


			// build header
			$name = strtoupper($this->form_name);
			$layout .= "\n\n<!-- ## ".$name." -->\n";
			$layout .= "<!--  - FORM HEADER -->\n<a name=\"msg_".$this->form_name."\"></a>\n";
			if ($_GET["confirm"] == 1 && !$_POST["s_".$this->form_name.""]) {
				$layout .= "<p style=\"color: #007700; font-weight: bold;\">".$this->confirmation_on_success_msg."</p>\n";
			}
			if ($msg["general_error"] != "") {
				print "<p><span style=\"color: #FF0000;\"><strong>Fehler:</strong></span> " . $msg["general_error"] . "</p>";
			}
			if ($this->jump_to_anchor == true) {
				$anchor = "#msg_" . $this->form_name;
			}
			$layout .= "<form id=\"f_".$this->form_name."\" action=\"".$this->action . $anchor . "\" method=\"".$this->method."\"".$this->enctype."".$this->css.">\n";
			if ($this->sql_where != "") {
				$layout .= "<input type=\"hidden\" name=\"id\" value=\"".$res["".$this->sql_id.""]."\" />\n";
			}
			if ($this->enctype != "") {
				$layout .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$this->MAX_FILE_SIZE."\" />\n";
			}


			// layout
			global $dir;
			$layout .= "\n<!--  - FORM BODY -->\n";
			$file_name = "".$dir["home"].$this->layout."";

			if (is_file($file_name)) {
				
				$fp = fopen($file_name, "r");
				$layout .= fread($fp, filesize($file_name));
				fclose($fp);
					
				// insert variables
				for ($n = 0; $n < $count_namelist; $n++) {
					
					$search = "{".$this->namelist[$n]."}";
					for ($p = 1; array_key_exists("".$this->namelist[$n]."_".$p."", $this->fields); $p++) {
						
						// show the fields
						$key = "".$this->namelist[$n]."_".$p."";
						$value[0] = $res[$this->fields[$key]->get_name()];
						if($value[0] == "") {
							$value[0] = $this->fields[$key]->get_f_value();
						}
						$value[1] = $this->fields[$key];
						$replacement .= $this->fields[$key]->get_display($value);
						if ($msg["error"][$this->fields[$key]->get_name()] && $msg["general_error"] == "") {
							$replacement .= "<br /><p><span style=\"color: #FF0000;\"><strong>Fehler:</strong></span> " . $msg["error"][$this->fields[$key]->get_name()] . "</p>";
						}
					}

					$layout = str_replace($search, $replacement, $layout);
					unset ($replacement);

					if (strtolower(get_class($this->fields[$key])) == "filefield") {
						
						if ($this->fields[$key]->get_data_type() == "image" && $this->fields[$key]->get_v_show_image()) {
							
							$replacement .= "<img height='80' width='80' src='".$this->fields[$key]->get_file_dir().$value[0]."' />";
							$layout = str_replace("{show_".substr($search, 1), $replacement, $layout);
							unset ($replacement);
						}
					}
				}

				
				// footer
				$layout .= "\n\n<!--  - FORM FOOTER -->\n";
				if ($this->show_submit_button == true) {
					$layout .= "<input id=\"s_".$this->form_name."\" name=\"s_".$this->form_name."\" type=\"submit\" value=\"".$this->submit_value."\"".$this->submit_css." />\n";
				}
				if ($this->show_reset_button == true) {
					$layout .= "<input id=\"r_".$this->form_name."\" name=\"r_".$this->form_name."\" type=\"reset\" value=\"".$this->reset_value."\"".$this->reset_css." />\n";
				}
				if ($this->show_form_end == true) {
					$layout .= "</form>\n";
				}
				$layout .="<script type=\"text/javascript\">\n";
				$layout .= "<!--\n";
				$layout .= "document.getElementById('".$this->focus_field."').focus();\n";
				$layout .= "-->\n";
				$layout .= "</script>\n";
				$layout .= "<!--  ## ".$name." END -->\n\n";

			}
			else {
				
				// no layout assigned
				$layout .= $this->show_error("Diesem Formular wurde noch kein Layout
											zugewiesen oder das Layout konnte nicht geöffnet
											werden!",
											self::ERROR_NORMAL,
											true);
			}

			// print layout
			print $layout;

		}
		else {
			
			// no fields in the form
			$this->show_error("Keine Felder im Formular vorhanden!",
							self::ERROR_WARNING,
							false);
		}
		
	} // # END display
	
	
	
	/**
	 * Leitet auf die eigene Seite weiter. Dies ist nützlich, um zu verhindern,
	 * dass der Benutzer bei einem Refresh einen Dialog vom Browser angezeigt bekommt,
	 * der ihn frägt, ob er erneut POST-Daten senden möchte, obwohl das Formular
	 * bereits erfolgreich verarbeitet wurde.
	 * 
	 * @param 	msg
	 * 			The error tracking variable is used to determine if the form
	 * 			was sent valid.
	 */
	public function redirectOnValid($msg) {
		
		if ($msg["valid"]) {
			
			if ($this->confirmation_on_success == true && $_GET["confirm"] != 1) {
				$confirm = "&confirm=1";
			}
			
			header("Location: "
				. $_SERVER["PHP_SELF"]
				. "?"
				. $_SERVER["argv"][0]
				. $confirm
				. $this->redirect_url);
		
		}
		
		
	} // # END redirectOnValid



	/**
	 * Validates the form and processes it to the mysql database.
	 * It is also possible that a form has an extention to that
	 * function or replaces the function completely. This must
	 * be done in the OWNER_OBJECT. If the custom_type
	 * is not empty the function process_form of the OWNER_OBJECT
	 * will be called. Of course the OWNER_OBJECT must implement
	 * such a function for it to work.
	 * 
	 * @return	$msg
	 */
	public function process_form() {
		
		if ($this->custom_type == "replacement") {

			// custom form processing
			$msg = $this->OWNER_OBJECT->process_form();

		}
		else {

			// data validation
			$msg = $this->validate_data();

			// data upload
			$count_namelist = count($this->namelist);
			for ($n = 0; $n < $count_namelist; $n++)
			{
				for ($p = 1; array_key_exists("".$this->namelist[$n]."_".$p."", $this->fields); $p++)
				{
					$key = "".$this->namelist[$n]."_".$p."";
					if (get_class($this->fields[$key]) == "FileField" && $_FILES[$this->fields[$key]->get_name()]["name"] != "") {
						$msg = $this->upload_data($msg, $this->fields[$key]);
					}
				}
			}

			// all validators passed
			if ($msg["valid"]) {
				
				$check = false;
				if ($this->sql_where == "") { // form intended as insert

					// creating sql command
					for ($n = 0; $n < $count_namelist; $n++) {
						
						for ($p = 1; array_key_exists("".$this->namelist[$n]."_".$p."", $this->fields); $p++) {
							
							$key = "".$this->namelist[$n]."_".$p."";
							if ($this->fields[$key]->get_process_field() == true) {

								$var = "".$var."`".$this->fields[$key]->get_name()."`, ";
								
								if (get_class($this->fields[$key]) == "FileField") {
									$var2 = "".$var2."'".$_FILES[$this->fields[$key]->get_name()]["name"]."', ";
								}
								else {
									
									if ($this->fields[$key]->get_crypt() != false) {
										$val = crypt($_POST[$this->fields[$key]->get_name()]);
									}
									else {
										$val = $_POST[$this->fields[$key]->get_name()];
									}
									
									$var2 = "".$var2."'".$val."', ";
								}
								$check = true;
							}
						}
					}

					if ($check) {
							
						$var_count = strlen($var); $var_count = $var_count - 2;
						$var = substr($var, 0, $var_count);
						$var_count = strlen($var2); $var_count = $var_count - 2;
						$var2 = substr($var2, 0, $var_count);

						// actions
						$query = "INSERT INTO `".$this->sql_tblname."`(".$var.") VALUES (".$var2.")";
						$stmt = $this->PDO_DATA_ACCESS->prepare($query);
						$stmt->execute();
						
						$this->sql_insert_id = $this->PDO_DATA_ACCESS->lastInsertId();
					}

				}
				else { // form intented as update

					// creating sql command
					for ($n = 0; $n < $count_namelist; $n++) {
						
						for ($p = 1; array_key_exists("".$this->namelist[$n]."_".$p."", $this->fields); $p++) {
							
							$key = "".$this->namelist[$n]."_".$p."";
							if ($this->fields[$key]->get_process_field() != false) {
								
								if (get_class($this->fields[$key]) == "FileField") {
									
									if ($_FILES[$this->fields[$key]->get_name()]["name"] != "") {
										
										$var = "".$var."`".$this->fields[$key]->get_name()."` = '".$_FILES[$this->fields[$key]->get_name()]["name"]."', ";
									}
								}
								else {
									if ($this->fields[$key]->get_crypt() != false) {
										$val = crypt($_POST[$this->fields[$key]->get_name()]);
									}
									else {
										$val = $_POST[$this->fields[$key]->get_name()];
									}
									
									$var = "".$var."`".$this->fields[$key]->get_name()."` = '".$val."', ";
								}
							}
							$check = true;
						}
					}

					if ($check) {

						$var_count = strlen($var); $var_count = $var_count - 2;
						$var = substr($var, 0, $var_count);

						// actions
						$query = "UPDATE `".$this->sql_tblname."` SET ".$var." ".$this->sql_where."";
						$stmt = $this->PDO_DATA_ACCESS->prepare($query);
						$stmt->execute();
					}
				}

				// own process extention
				if ($msg["valid"]) {
					if ($this->custom_type == "extention") {
						$msg = $this->OWNER_OBJECT->process_form($msg);
					}
				}

				// Automatische Weiterleitung
				if ($this->redirect == true) {
					$this->redirectOnValid($msg);
				}
			}
		}

		
		return $msg;
		
	} // # END process_form



	/**
	 * Each field can have severalvalidators. For each validator
	 * it will be checked.
	 * 
	 * @return	$msg
	 */
	public function validate_data()
	{
		$msg["valid"] = true;
		$count_namelist = count($this->namelist);

		for ($n = 0; $n < $count_namelist; $n++)
		{
			for ($p = 1; array_key_exists("".$this->namelist[$n]."_".$p."", $this->fields); $p++)
			{
				$key = "".$this->namelist[$n]."_".$p."";
					
				if (get_class($this->fields[$key]) == "FileField")
				{
					$value = $_FILES["".$this->fields[$key]->get_name().""]["name"];
				} else {
					$value = $_POST["".$this->fields[$key]->get_name().""];
				}

				$file = $_FILES["".$this->fields[$key]->get_name().""];
				if (strpos($this->fields[$key]->get_caption(), ":")) {
					$caption = str_replace(":", "", "".$this->fields[$key]->get_caption()."");
				} else {
					$caption = $this->fields[$key]->get_caption();
				}

				// v_required
				if ($this->fields[$key]->get_v_required() == true)
				{
					if ($value == "") {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> muss angegeben werden.";
						$msg["valid"] = false;
					}
				}

				// v_email
				if ($this->fields[$key]->get_v_email() == true) {
					if (!strpos($value, '@') || !strpos($value, '.') || strlen($value) < 5) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> muss eine g&uuml;ltige E-Mail Adresse beinhalten.";
						$msg["valid"] = false;
					}
				}

				// v_link
				if ($this->fields[$key]->get_v_link() == true && $value != "") {
					if (!strpos($value, '.') || strlen($value) < 4) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> muss einen g&uuml;ltigen Link beinhalten.";
						$msg["valid"] = false;
					}
				}

				// v_numeric
				if ($this->fields[$key]->get_v_numeric() == true) {
					if (!is_numeric($value) && $value != "") {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> muss einen numerischen Wert beinhalten.";
						$msg["valid"] = false;
					}
				}

				// v_maxlength
				if (is_integer($this->fields[$key]->get_v_maxlength()) && $this->fields[$key]->get_v_maxlength() > 0)
				{
					if (strlen($value) > $this->fields[$key]->get_v_maxlength()) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> darf h&ouml;chstens ".$this->fields[$key]->get_v_maxlength()." Zeichen lang sein.";
						$msg["valid"] = false;
					}
				}

				// v_minlength
				if (is_integer($this->fields[$key]->get_v_minlength()) && $this->fields[$key]->get_v_minlength() > 0)
				{
					if (strlen($value) < $this->fields[$key]->get_v_minlength()) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> muss mindestens ".$this->fields[$key]->get_v_minlength()." Zeichen lang sein.";
						$msg["valid"] = false;
					}
				}

				// v_onlylowercase
				if ($this->fields[$key]->get_v_onlylowercase() == true) {
					$var = strtolower($value);
					if ($value != $var) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> darf nur kleingeschriebene Zeichen beinhalten.";
						$msg["valid"] = false;
					}
				}

				// v_nospace
				if ($this->fields[$key]->get_v_nospace() == true) {
					if (strpos($value, " ")) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> darf keine Leerzeichen beinhalten.";
						$msg["valid"] = false;
					}
				}

				// v_minvalue
				if (is_numeric($this->fields[$key]->get_v_minvalue()) && $this->fields[$key]->get_v_minvalue() > 0)
				{
					if ($value < $this->fields[$key]->get_v_minvalue()) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> darf nicht kleiner sein als ".$this->fields[$key]->get_v_minvalue().".";
						$msg["valid"] = false;
					}
				}

				// v_maxvalue
				if (is_numeric($this->fields[$key]->get_v_maxvalue()) && $this->fields[$key]->get_v_maxvalue() > 0)
				{
					if ($value > $this->fields[$key]->get_v_maxvalue()) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> darf nicht gr&ouml;ßer sein als ".$this->fields[$key]->get_v_maxvalue().".";
						$msg["valid"] = false;
					}
				}

				// v_isunique
				if ($this->fields[$key]->get_v_isunique() == true) {

					if ($value != "") {
						
						$query1 = "SELECT `".$this->fields[$key]->get_name()."` FROM `".$this->sql_tblname."` WHERE `".$this->fields[$key]->get_name()."` = :value";
						$stmt1 = $this->PDO_DATA_ACCESS->prepare($query1);
						$stmt1->bindParam(":value", $value);
						$stmt1->execute();

						if ($stmt1->fetch()) {

							$msg["error"][$this->namelist[$n]] = "Es existiert bereits ein Eintrag mit ".$value." als <strong>".$this->fields[$key]->get_caption()."</strong>.";
							$msg["valid"] = false;

						}

					}

				}

				// v_confirms
				if ($this->fields[$key]->get_v_confirms() != "") {
					if ($_POST[$this->fields[$key]->get_v_confirms()] != $_POST[$this->fields[$key]->get_name()]) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> enstpricht nicht dem entsprechenden Feld.";
						$msg["valid"] = false;
					}
				}

				// v_nospecial
				if ($this->fields[$key]->get_v_nospecial() == true) {
					if (!ereg ("^[a-zA-Z0-9 ]*$", $_POST[$this->fields[$key]->get_name()])) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> enth&auml;lt Sonderzeichen.";
						$msg["valid"] = false;
					}
				}

				// v_nosql
				if ($this->fields[$key]->get_v_nosql() == true) {
					if (strpos($value, '$') || strpos($value, '\"') || strpos($value, '\'')) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> enth&auml;lt verbotene Zeichen.";
						$msg["valid"] = false;
					}
				}

				// v_allowed
				$allowed = $this->fields[$key]->get_v_allowed();
				if ($allowed != "") {
					$ok = false;
					for ($i = 0; $i < count($allowed); $i++) {
						if ($value == $allowed[$i]) {
							$ok = true;
						}
					}
					if ($ok == false) {
						$msg["error"][$this->namelist[$n]] = "Das Feld <strong>".$this->fields[$key]->get_caption()."</strong> enth&auml;lt verbotene Werte.";
						$msg["valid"] = false;
					}
				}

			}
		}

		
		return $msg;
		
	} // # END validate_data



	/**
	 * Uploads files coming from forms to the server.
	 *
	 * @param	$msg
	 * 			If an error occured while processing the form it can be
	 * 			given to the function and it will be displayed.
	 * 
	 * @param	$field
	 * 			The FileField which contains the uploaded file.
	 * 
	 * @return	$msg
	 */
	public function upload_data($msg, FileField $field) {
		
		// create dir if non-existent
		if (!is_dir($field->get_file_dir())) {

			mkdir($field["file_dir"]);
			chmod($field["file_dir"], 0777);

		}
			
		$data = $_FILES[$field->get_name()];

		// upload image data
		if ($field->get_data_type() == "image") {

			// check that the image isn't larger than the maximum allowed file size
			if ($data["size"] > $_POST["MAX_FILE_SIZE"]) {

				$kb = $_POST["MAX_FILE_SIZE"] / 1024;
				$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Die maximale Dateigröße beträgt ".$kb." KB!";
				$msg["valid"] = false;
					
			}

		}

		// check if the data has been uploaded and if the file type is allowed
		if (!is_uploaded_file($data["tmp_name"])) {

			$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Datei konnte nicht hochgeladen werden! Datei zu groß?";
			$msg["valid"] = false;

		}
		else {

			$file_types = $field->get_file_types();
			$count = count($file_types);
			$var = false;

			for ($i = 0; $i < $count; $i++) {

				if ($data["type"] == $file_types[$i]) {
					$var = true;
				}

			}

			if (!$var) {

				$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Dieser Dateityp (".$data["type"].") ist nicht erlaubt!";
				$msg["valid"] = false;

			}

		}

		// check if data exists already
		$file = "".$field->get_file_dir()."".$data["name"].""; // file name
		if ($data["name"] != "") {

			$query = "SELECT `".$field->get_name()."` FROM `".$this->sql_tblname."` WHERE `".$this->sql_id."` = :sql_id";
			$stmt = $this->PDO_DATA_ACCESS->prepare($query);
			$stmt->bindParam(":sql_id", $_POST["id"]);
			$stmt->execute();
			$res = $stmt->fetchAll();

			if (file_exists($file) && $data["name"] != $res[0])	{

				$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Dieser Dateiname existiert bereits.";
				$msg["valid"] = false;
					
			}

		}


		if ($msg["valid"]) {

			// create new data
			if ($this->sql_where != "" && $data["name"] != "") {
				if (is_file("".$field->get_file_dir()."".$res[0]."")) { unlink("".$field->get_file_dir()."".$res[0].""); }
			}

			move_uploaded_file($data["tmp_name"] , $file);
			chmod($file, 0777);

			// check if image dimensions match defined ones
			if ($field->get_data_type() == "image") {

				$size = getimagesize($file);
				$image_dimensions = $field->get_image_dimensions();
				$check = true;

				switch ($image_dimensions["check"]) {

					case "up_to":

						if ($size[0] > $image_dimensions["x"] || $size[1] > $image_dimensions["y"]) {
							
							$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Die Dimensionen des Bildes übersteigen ".$image_dimensions["x"]." x ".$image_dimensions["y"]." Pixel.";
							$msg["valid"] = false;
							$check = false;
							
						}
						
						break;

					case "smaller":
							
						if ($size[0] >= $image_dimensions["x"] || $size[1] >= $image_dimensions["y"]) {
							
							$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Die Dimensionen des Bildes sind größer als ".$image_dimensions["x"]." x ".$image_dimensions["y"]." Pixel.";
							$msg["valid"] = false;
							$check = false;
							
						}
						
						break;

					case "bigger":
							
						if ($size[0] <= $image_dimensions["x"] || $size[1] <= $image_dimensions["y"]) {
							
							$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Die Dimensionen des Bildes sind kleiner als ".$image_dimensions["x"]." x ".$image_dimensions["y"]." Pixel.";
							$msg["valid"] = false;
							$check = false;
							
						}
						
						break;

					case "same":
							
						if ($size[0] != $image_dimensions["x"] || $size[1] != $image_dimensions["y"]) {
							
							$msg["error"][$field->get_name()] = "<strong>".$field->get_caption()."</strong>: Die Dimensionen des Bildes entsprechen nicht ".$image_dimensions["x"]." x ".$image_dimensions["y"]." Pixel.";
							$msg["valid"] = false;
							$check = false;
							
						}
						
						break;

				}

			}

			if ($check == false) {

				$query = "UPDATE `".$this->sql_tblname."` SET `".$field->get_name()."` = '' WHERE `".$this->sql_id."` = :sql_id";
				$stmt = $this->PDO_DATA_ACCESS->prepare($query);
				$stmt->bindParam(":sql_id", $_POST["id"]);
				$stmt->execute();

				unlink($file);
					
			}

		}

		
		return $msg;
		
	} // # END upload_data

}

?>