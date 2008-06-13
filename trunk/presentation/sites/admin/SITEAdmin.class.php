<?php

// Weil SITEAdmin in index.php eingebunden wird
// Es wird immer von der Datei ausgegangen, die im
// Browser ausgeführt wird
require_once("presentation/sites/SITE.class.php");
require_once("logic/UC.class.php");


class SITEAdmin extends SITE {
	
	
	public function SITEAdmin() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UC());

		// Attribute initialisieren
		$this->template = TPL_Admin;
														
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();		
		
	} // # END SITEAdmin
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen	
		
	} // # END fillTemplate

}

?>