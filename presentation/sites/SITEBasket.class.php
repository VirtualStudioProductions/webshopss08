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
		$article = $this->useCase->getArticle($this->arNumber);
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("article", $article);
		
	} // # END fillTemplate

}

?>