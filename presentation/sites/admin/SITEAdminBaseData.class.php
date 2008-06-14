<?php

require_once("api/form/Form.class.php");
require_once("api/form/Field.class.php");
require_once("presentation/sites/SITE.class.php");
require_once("logic/admin/UCAdminBaseData.class.php");


class SITEAdminBaseData extends SITE {
	
	
	/** Das Datensatz hinzufügen - Formular */
	protected $F_NEWDATA;
	
	
	public function SITEAdminBaseData() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCAdminBaseData($_GET["basedata"]));

		// Attribute initialisieren
		$this->template = TPL_AdminBaseData;
		$this->F_NEWDATA = $this->useCase->createNewDataForm();
														
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
		// Private Funktion actions aufrufen
		$this->actions();
		
	} // # END SITEAdminBaseData
	
	
	private function actions() {
		
		// Formularverarbeitung
		if ($_POST["s_" . $this->F_NEWDATA->get_form_name()]) {
			$msg = $this->F_NEWDATA->process_form();
			$this->TEMPLATE_ENGINE->assign("msg", $msg);
		}
		
		
	} // # END actions
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		
		$this->TEMPLATE_ENGINE->assign("baseDataTitle", $this->useCase->getBaseDataTitle());
		
		// Das Formular erzeugen, mit dem neue Datensätze angelegt werden können
		// und an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("F_NEWDATA", $this->F_NEWDATA);
		
		// Alle Einträge zum jeweiligen Stammdatum aus der Logik holen
		// und an das Template zuweisen
		$allBaseData = $this->useCase->getAllBaseData();
		$this->TEMPLATE_ENGINE->assign("allBaseData", $allBaseData);
		
	} // # END fillTemplate

}

?>