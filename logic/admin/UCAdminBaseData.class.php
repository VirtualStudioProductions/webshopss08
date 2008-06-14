<?php

require_once("logic/UC.class.php");


class UCAdminBaseData extends UC {
	
	
	/** DAO für das spezifische Stammdatum */
	private $DAO;
	
	/** Welches Stammdatum wird verwaltet */
	private $baseData;
	
	/** Die Bezeichnung des Stammdatums */
	private $baseDataTitle;
	
	
	/** Getter für die Stammdaten - Bezeichnung */
	public function getBaseDataTitle()	{	return $this->baseDataTitle;	}
	
	
	public function UCAdminBaseData($baseData) {
		
		parent::UC(); // Aufruf Elternkonstruktor

		
		// Je nach Stammdatum richtiges DAO initialisieren
		// und richtigen Titel zuweisen.
		// Bei ungültiger Stammdatum-Angabe den Benutzer
		// umleiten.
		switch ($baseData) {
			
			case "article":
				
				require_once("dao/DAOArticle.class.php");
				
				$this->baseDataTitle = "Artikel";
				$this->DAO = new DAOArticle();
				
				break;
				
				
			case "customer":
				
				require_once("dao/DAOCustomer.class.php");
				
				$this->baseDataTitle = "Kunden";
				$this->DAO = new DAOCustomer();
				
				break;
				
				
			case "category":
				
				require_once("dao/DAOCategory.class.php");
				
				$this->baseDataTitle = "Kategorien";
				$this->DAO = new DAOCategory();
				
				break;
				
				
			case "subcategory":
				
				require_once("dao/DAOSubCategory.class.php");
				
				$this->baseDataTitle = "Unter-Kategorien";
				$this->DAO = new DAOSubCategory();
				
				break;
				
				
			default:
				
				// Weiterleitung zur Hauptseite, falls kein Fall zutrifft
				header("Location: " . $_SERVER["PHP_SELF"] . "?site=admin&handheld=" . $_GET["handheld"]);
				break;
			
		}
		
		$this->baseData = $baseData;
		
	
	} // # END UCAdminBaseData
	
	
	/**
	 * Holt aus der Datenschicht alle Einträge zum
	 * jeweiligen Stammdatum.
	 *
	 * @return array Array mit allen Stammdaten-Einträgen
	 */
	public function getAllBaseData() {
		
		switch ($this->baseData) {

			case "article":
				$allBaseData = $this->DAO->getAllArticles();				
				break;				
				
			case "customer":
				$allBaseData = $this->DAO->getAllCustomers();
				break;
				
			case "category":
				$allBaseData = $this->DAO->getAllCategories();
				break;
				
			case "subcategory":
				$allBaseData = $this->DAO->getAllSubCategoriesWithParent();
				break;
					
		}
		
		return $allBaseData;
		
		
	} // # END getAllBaseData
	
	
	public function deleteBaseDataRow() {
		
		switch ($this->baseData) {

			case "article":
				if (is_numeric($_GET["ar_id"])) {
					$deleted = $this->DAO->deleteArticle($_GET["ar_id"]);
				}
				break;				
				
			case "customer":
				if (is_numeric($_GET["cu_id"])) {
					$deleted = $this->DAO->deleteCustomer($_GET["cu_id"]);
				}
				break;
				
			case "category":
				if (is_numeric($_GET["cat_id"])) {
					$deleted = $this->DAO->deleteCategory($_GET["cat_id"]);
				}
				break;
				
			case "subcategory":
				if (is_numeric($_GET["sub_id"])) {
					$deleted = $this->DAO->deleteSubCategory($_GET["sub_id"]);
				}
				break;

		}
		
		return $deleted;
		
		
	} // # END deleteBaseDataRow
	
	
	public function createNewDataForm() {
		
		switch ($this->baseData) {
			
			case "article":
				$form = $this->createNewArticleForm();
				break;				
				
			case "customer":
				$form = $this->createNewCustomerForm();
				break;
				
			case "category":
				
				break;
				
			case "subcategory":
				
				break;
			
		}
		
		
		return $form;
		
		
	} // # END createNewDataForm
	
	
	private function createNewCustomerForm() {
		
		global $DATA_ACCESS;
		
		
		// Formular erstellen
		$F_CUSTOMER = new Form(
							"newcustomer",
							FORM_LAYOUT_DIR_ADMIN,
							array("cu_username", "cu_password", "cu_firstname",
									"cu_lastname", "cu_phone", "cu_email", "cu_number",
									"cu_admin"),
							TBL_CUSTOMER,
							"",
							"cu_id",
							"",
							"",
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_CUSTOMER->set_show_reset_button(false);
		$F_CUSTOMER->set_submit_value("Kunde anlegen!");
		$F_CUSTOMER->set_action($_SERVER["PHP_SELF"] .
								"?site=" . $_GET["site"] .
								"&basedata=" . $_GET["basedata"] .
								"&handheld=" . $_GET["handheld"]);
		
		// Bestätigung bei Erfolg anzeigen lassen
		$F_CUSTOMER->set_confirmation_on_success(true);
		$F_CUSTOMER->set_confirmation_on_success_msg(
			"Der neue " . $this->baseDataTitle . " - Datensatz wurde
			erfolgreich hinzugef&uuml;gt!");
		
		// Zu Beginn fokusiertes Feld festlegen
		$F_CUSTOMER->set_focus_field("cu_username");
		
		
		// Formular Felder hinzufügen
		
		// Username
		$FIELD = new TextField("cu_username", "Username", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_nospecial(true);
		$FIELD->set_v_minlength(6);
		$FIELD->set_v_maxlength(50);
		$F_CUSTOMER->add_field($FIELD);
		
		// Passwort
		$FIELD = new PasswordField("cu_password", "Passwort", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_minlength(6);
		$FIELD->set_v_maxlength(50);
		$FIELD->set_crypt(true);
		$F_CUSTOMER->add_field($FIELD);
		
		// Vorname
		$FIELD = new TextField("cu_firstname", "Vorname", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(50);
		$F_CUSTOMER->add_field($FIELD);
		
		// Nachname
		$FIELD = new TextField("cu_lastname", "Nachname", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(50);
		$F_CUSTOMER->add_field($FIELD);
		
		// E-Mail
		$FIELD = new TextField("cu_email", "E-Mail", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_email(true);
		$FIELD->set_v_maxlength(50);
		$F_CUSTOMER->add_field($FIELD);
		
		// Telefon
		$FIELD = new TextField("cu_phone", "Telefon", " class=\"textField\"", 20);
		$FIELD->set_v_maxlength(20);
		$F_CUSTOMER->add_field($FIELD);
		
		// Admin
		$FIELD = new CheckBox("cu_admin", "Admin", 1);
		$FIELD->set_v_numeric(true);
		$FIELD->set_v_maxlength(1);
		$FIELD->set_v_maxvalue(1);
		$F_CUSTOMER->add_field($FIELD);
		
		// Kundennummer
		$FIELD = new HiddenField("cu_number", $this->computeCustomerNumber());
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(10);
		$F_CUSTOMER->add_field($FIELD);
		
		
		return $F_CUSTOMER;
		
		
	} // # END createNewCustomerForm
	
	
	/**
	 * Baut die Kundennummer für den neuen Kunden zusammen.
	 *
	 * @return Eine eindeutige Kundennummer
	 */
	private function computeCustomerNumber() {
		
		$lastID = $this->DAO->getLastID();
		$number = $lastID + 1;
		
		if ($number < 10)
			$zeros = "000000";
		else if ($number >= 10 && $number < 100)
			$zeros = "00000";
		else if ($number >= 100 && $number < 1000)
			$zeros = "0000";
		else if ($number >= 1000 && $number < 10000)
			$zeros = "000";
		else if ($number >= 10000 && $number < 100000)
			$zeros = "00";
		else if ($number >= 100000 && $number < 1000000)
			$zeros = "0";
		else
			$zeros = "";
			
	
		return "WS_". $zeros . $number;
		
		
	} // # END computeCustomerNumber
	
	
	private function createNewArticleForm() {
		
		global $DATA_ACCESS;
		
		
		// Formular erstellen
		$F_ARTICLE = new Form(
							"newarticle",
							FORM_LAYOUT_DIR_ADMIN,
							array("ar_number", "ar_title", "ar_price",
							"ar_description", "ar_stock", "fk_sub_id"),
							TBL_ARTICLE,
							"",
							"ar_id",
							"",
							"",
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_ARTICLE->set_show_reset_button(false);
		$F_ARTICLE->set_submit_value("Artikel anlegen!");
		$F_ARTICLE->set_action($_SERVER["PHP_SELF"] .
								"?site=" . $_GET["site"] .
								"&basedata=" . $_GET["basedata"] .
								"&handheld=" . $_GET["handheld"]);
		
		// Bestätigung bei Erfolg anzeigen lassen
		$F_ARTICLE->set_confirmation_on_success(true);
		$F_ARTICLE->set_confirmation_on_success_msg(
			"Der neue " . $this->baseDataTitle . " - Datensatz wurde
			erfolgreich hinzugef&uuml;gt!");
		
		// Zu Beginn fokusiertes Feld festlegen
		$F_ARTICLE->set_focus_field("ar_number");
		
		
		// Formular Felder hinzufügen
		
		// Nummer
		$FIELD = new TextField("ar_number", "Nummer", " class=\"textField\"", 10);
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_nospecial(true);
		$FIELD->set_v_maxlength(10);
		$FIELD->set_v_numeric(true);
		$F_ARTICLE->add_field($FIELD);
		
		// Bezeichnung
		$FIELD = new TextField("ar_title", "Bezeichnung", " class=\"textField\"", 100);
		$FIELD->set_v_required(true);
		$FIELD->set_v_minlength(5);
		$FIELD->set_v_maxlength(100);
		$F_ARTICLE->add_field($FIELD);
		
		
		
		// Unter-Kategorie
		$FIELD = new SelectField("fk_sub_id", "Unter-Kategorie", " class=\"textField\"");
		
		$OPTION = new SelectOption("-- Bitte ausw&auml;hlen --", "");
		$FIELD->add_option($OPTION);
		$OPTION = new SelectOption("", "");
		$FIELD->add_option($OPTION);
		
		$categories = $this->DAOCategory->getAllCategories();
		foreach ($categories as &$currentCategory) {
			
			$OPTION = new SelectOption(htmlentities($currentCategory["name"]), "");
    		$FIELD->add_option($OPTION);
    		
    		$subcategories = $this->DAOSubCategory->getAllSubCategoriesFromParent($currentCategory["id"]);
			foreach ($subcategories as &$currentSubCategory) {
				$OPTION = new SelectOption(htmlentities("- " . $currentSubCategory["sub_name"]), $currentSubCategory["sub_id"]);
    			$FIELD->add_option($OPTION);
			}
			
			$OPTION = new SelectOption("", "");
			$FIELD->add_option($OPTION);
			
		}
		
		$FIELD->set_v_required(true);
		
		$F_ARTICLE->add_field($FIELD);
		
		
		
		// Preis
		$FIELD = new TextField("ar_price", "Preis", " class=\"smallTextField\"", 11);
		$FIELD->set_v_required(true);
		$FIELD->set_v_numeric(true);
		$FIELD->set_v_maxlength(11);
		$F_ARTICLE->add_field($FIELD);
		
		// Stückzahl
		$FIELD = new TextField("ar_stock", "St&uuml;ckzahl", " class=\"smallTextField\"", 10);
		$FIELD->set_v_required(true);
		$FIELD->set_v_numeric(true);
		$FIELD->set_v_maxlength(10);
		$F_ARTICLE->add_field($FIELD);
		
		// Beschreibung
		$FIELD = new TextArea("ar_description", "Beschreibung", "", 8, 40);
		$FIELD->set_v_required(true);
		$F_ARTICLE->add_field($FIELD);
	
		
		return $F_ARTICLE;
		
		
	} // # END createNewArticleForm
	
}

?>