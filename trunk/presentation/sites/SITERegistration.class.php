<?php

require_once("api/form/Form.class.php");
require_once("api/form/Field.class.php");
require_once("logic/UCRegistration.class.php");
require_once("SITE.class.php");


class SITERegistration extends SITE {
		
	
	/** Das Registrierungs-Formular */
	protected $F_REGISTRATION;
	
	
	public function SITERegistration() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCRegistration());
		
		// Attribute initialisieren
		$this->template = TPL_Registration;
		
		
		// Registration Formular erzeugen
		$this->F_REGISTRATION = $this->useCase->createRegistrationForm();
										
										
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
		// Private Funktion actions aufrufen
		$this->actions();
		
		
	} // # END SITERegistration
	
	
	private function actions() {
		
		// Formularverarbeitung
		if ($_POST["s_" . $this->F_REGISTRATION->get_form_name()]) {
			$msg = $this->F_REGISTRATION->process_form();
			$this->TEMPLATE_ENGINE->assign("msg", $msg);
		}
		
		
	} // # END actions
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("F_REGISTRATION", $this->F_REGISTRATION);
	
		
	} // # END fillTemplate

}

?>