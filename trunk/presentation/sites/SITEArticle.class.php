<?php

require_once("logic/UCArticle.class.php");
require_once("SITE.class.php");


class SITEArticle extends SITE {
	
	private $arNumber;
	
	public function SITEArticle($arNumber) {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE(new UCArticle());
		
		$this->template = TPL_Article;
				
		//Artikelnummer als Attribut für fillTemplate hinterlegen
		$this->arNumber = $arNumber;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEArticle
	
	
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