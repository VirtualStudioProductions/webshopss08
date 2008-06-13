<?php

require_once("presentation/sites/SITE.class.php");
require_once("logic/admin/UCAdminBaseData.class.php");


class SITEAdminBaseData extends SITE {
	
	
	public function SITEAdminBaseData() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCAdminBaseData($_GET["basedata"]));

		// Attribute initialisieren
		$this->template = TPL_AdminBaseData;
														
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();		
		
	} // # END SITEAdminBaseData
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen

		// Richtige Bezeichnung zuweisen
		switch ($_GET["basedata"]) {
			
			case "article":
				$baseDataTitle = "Artikel";
				break;
				
			case "customer":
				$baseDataTitle = "Kunden";
				break;
				
			case "category":
				$baseDataTitle = "Kategorien";
				break;
				
			case "subcategory":
				$baseDataTitle = "Unter-Kategorien";
				break;
				
			default:
				// Weiterleitung zur Hauptseite, falls kein Fall zutrifft
				header("Location: " . $_SERVER["PHP_SELF"] . "?site=admin&handheld=" . $_GET["handheld"]);
				break;
								
		}
		
		$this->TEMPLATE_ENGINE->assign("baseDataTitle", $baseDataTitle);
		
		// Alle Einträge zum jeweiligen Stammdatum aus der Logik holen
		// und an das Template zuweisen
		$allBaseData = $this->useCase->getAllBaseData();
		$this->TEMPLATE_ENGINE->assign("allBaseData", $allBaseData);
		
	} // # END fillTemplate

}

?>