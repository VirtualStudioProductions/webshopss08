<?php

require_once("SITE.class.php");
require_once("logic/UCStartpage.class.php");


class SITEStartpage extends SITE {
	
	
	public function SITEStartpage() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCStartpage());
		
		// Attribute initialisieren
		$this->template = TPL_Startpage;
														
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();		
		
	} // # END SITEStartpage
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen	
		
		//in diesem array stehen alle neuen artikel mit ihren attributen
		$new_articles = $this->useCase->listNewArticles();
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("new_articles", $new_articles);
		
		
	} // # END fillTemplate

}

?>