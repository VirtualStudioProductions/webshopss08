<?php

require_once("SITE.class.php");
require_once("logic/UC.class.php");


class SITEStartpage extends SITE {
	
	
	public function SITEStartpage($TEMPLATE_ENGINE) {
		
		// super Konstruktor aufrufen
		parent::SITE($TEMPLATE_ENGINE, new UC());
		
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
		
	} // # END fillTemplate

}

?>