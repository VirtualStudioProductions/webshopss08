<?php

require_once("SITE.class.php");
require_once("logic/UC.class.php");


class SITEImpressum extends SITE {
	
	
	public function SITEImpressum() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UC());
		
		// Attribute initialisieren
		$this->template = TPL_Impressum;
														
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();		
		
	} // # END SITEImpressum
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen	
		
	} // # END fillTemplate

}

?>