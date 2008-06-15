<?php

require_once("api/form/Form.class.php");
require_once("api/form/Field.class.php");
require_once("presentation/sites/SITE.class.php");
require_once("logic/admin/UCAdminBaseData.class.php");


class SITEAdminBaseData extends SITE {
	
	
	/** Das Formular */
	protected $F_BASEDATA;
	
	
	public function SITEAdminBaseData() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCAdminBaseData($_GET["basedata"]));

		// Attribute initialisieren
		$this->template = TPL_AdminBaseData;
		
		if ($_GET["edit"] == 1 &&
			(	is_numeric($_GET["ar_id"])
				|| is_numeric($_GET["cat_id"])
				|| is_numeric($_GET["sub_id"])
				|| is_numeric($_GET["cu_id"])
			)) {
			
			$this->TEMPLATE_ENGINE->assign("update", true);
			$this->F_BASEDATA = $this->useCase->createBaseDataForm(true);
		}
		else {
			$this->TEMPLATE_ENGINE->assign("update", false);
			$this->F_BASEDATA = $this->useCase->createBaseDataForm(false);
		}

		// Private Funktion actions aufrufen
		$this->actions();
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEAdminBaseData
	
	
	private function actions() {
		
		// Formularverarbeitung des Formulares
		if ($_POST["s_" . $this->F_BASEDATA->get_form_name()]) {
			$msg = $this->F_BASEDATA->process_form();
			$this->TEMPLATE_ENGINE->assign("msg", $msg);
		}

		
		// Datensatz löschen
		$baseDataDeleted = false;
		if ($_GET["delete"] == 1) {
			$baseDataDeleted = $this->useCase->deleteBaseDataRow();
		}
		$this->TEMPLATE_ENGINE->assign("baseDataDeleted", $baseDataDeleted);
		
		
	} // # END actions
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		
		$this->TEMPLATE_ENGINE->assign("baseDataTitle", $this->useCase->getBaseDataTitle());
		
		// Das Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("F_BASEDATA", $this->F_BASEDATA);
		
		
		// Alle Einträge zum jeweiligen Stammdatum aus der Logik holen
		// und an das Template zuweisen
		$allBaseData = $this->useCase->getAllBaseData();
		$this->TEMPLATE_ENGINE->assign("allBaseData", $allBaseData);
		
	} // # END fillTemplate

}

?>