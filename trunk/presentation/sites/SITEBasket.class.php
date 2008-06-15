<?php

require_once("logic/UCBasket.class.php");
require_once("SITE.class.php");


class SITEBasket extends SITE {
	
	
	public function SITEBasket() {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE(new UCBasket());
		
		$this->template = TPL_Basket;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEItemOverview
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// Immer mit this auf Attribute zugreifen !!
		
		
		// TEST Befüllung von $_SESSION["basket"]
		$_SESSION["basket"][0] = 1;
		$_SESSION["basket"][1] = 2;
		$_SESSION["basket"][2] = 3;
		
		$selectedArticle = $this->useCase->getSelectedArticle();
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("selectedArticle", $selectedArticle);
		
	} // # END fillTemplate

}

?>