<?php

require_once("logic/UCArticle.class.php");
require_once("SITE.class.php");


class SITEArticle extends SITE {
	
	public function SITEArticle($TEMPLATE_ENGINE, $arNumber) {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE($TEMPLATE_ENGINE, new UCArticle());
		
		$this->template = TPL_Article;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEItemOverview
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		print $arNumber;
		$article = $useCase->getArticle($arNumber);
		print_r($article);		
	} // # END fillTemplate

}

?>