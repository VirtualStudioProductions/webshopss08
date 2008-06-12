<?php

require_once("api/form/Form.class.php");
require_once("api/form/Field.class.php");
require_once("logic/UCContact.class.php");
require_once("SITE.class.php");


class SITEContact extends SITE {
		
	
	/** Das Kontakt-Formular */
	protected $F_CONTACT;
	
	
	public function SITEContact() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCContact());
		
		// Attribute initialisieren
		$this->template = TPL_Contact;
		
		// Kontakt Formular erzeugen
		$this->F_CONTACT = $this->useCase->createContactForm();
										
										
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
		// Private Funktion actions aufrufen
		$this->actions();
		
		
	} // # END SITELogin
	
	
	private function actions() {
		
		// Formularverarbeitung
		if ($_POST["s_" . $this->F_CONTACT->get_form_name()]) {
			$msg = $this->F_CONTACT->process_form();
			$this->TEMPLATE_ENGINE->assign("msg", $msg);
		}		
		
		
	} // # END actions
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("F_CONTACT", $this->F_CONTACT);
					
		
	} // # END fillTemplate

}

?>