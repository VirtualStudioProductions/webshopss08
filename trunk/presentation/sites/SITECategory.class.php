<?php
require_once("SITE.class.php");
require_once("logic/UC.class.php");

class SITECategory extends SITE {

		public function SITECategory($TEMPLATE_ENGINE) {
		
		// �quivalent zum "super" Aufruf in Java*
		parent::SITE($TEMPLATE_ENGINE, new UC());
		
		$this->template = TPL_Category;
				
		//Artikelnummer als Attribut f�r fillTemplate hinterlegen
		//$this->arNumber = $arNumber;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEItemOverview
	
	
}

?>