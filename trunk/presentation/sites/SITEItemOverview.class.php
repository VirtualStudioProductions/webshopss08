<?php

require_once("logic/UCItemOverview.class.php");
require_once("SITE.class.php");


class SITEItemOverview extends SITE {
	
	

	
	
	public function SITEItemOverview($TEMPLATE_ENGINE) {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE($TEMPLATE_ENGINE, new UCItemOverview());
		
		$this->template = TPL_ItemOverview;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEItemOverview
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// $items enthält dann alle DB Einträge der Artikel
		$items = $this->useCase->listAllItems();

		// Das $items Array ist nun unter dem Namen "items" im Template verfügbar
		$this->TEMPLATE_ENGINE->assign("items", $items);
	
	} // # END fillTemplate

}

?>