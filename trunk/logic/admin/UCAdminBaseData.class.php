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
	
	
	public function createNewDataForm() {
		
		switch ($this->baseData) {
			
			case "article":
				$form = $this->createNewArticleForm();
				break;				
				
			case "customer":
				
				break;
				
			case "category":
				
				break;
				
			case "subcategory":
				
				break;
			
		}
		
		
		return $form;
		
		
	} // # END createNewDataForm
	
	
	private function createNewArticleForm() {
		
		global $DATA_ACCESS;
		
		
		// Formular erstellen
		$F_ARTICLE = new Form(
							"newarticle",
							FORM_LAYOUT_DIR_ADMIN,
							array("ar_number", "ar_title", "ar_price",
							"ar_description", "ar_stock"),
							TBL_ARTICLE,
							"",
							"ar_id",
							"",
							"",
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_ARTICLE->set_show_reset_button(false);
		$F_ARTICLE->set_submit_value("Artikel anlegen!");
		
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