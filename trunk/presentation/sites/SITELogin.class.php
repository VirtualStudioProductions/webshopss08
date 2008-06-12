<?php

require_once("api/form/Form.class.php");
require_once("api/form/Field.class.php");
require_once("logic/UCLogin.class.php");
require_once("SITE.class.php");


class SITELogin extends SITE {
		
	
	/** Das Login-Formular */
	protected $F_LOGIN;
	
	
	public function SITELogin() {
		
		// super Konstruktor aufrufen
		parent::SITE(new UCLogin());
		
		// Attribute initialisieren
		$this->template = TPL_Login;
		
		// Login Formular erzeugen
		$this->F_LOGIN = $this->useCase->createLoginForm();
										
										
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
		// Private Funktion actions aufrufen
		$this->actions();
		
		
	} // # END SITELogin
	
	
	private function actions() {
		
		// Formularverarbeitung
		if ($_POST["s_" . $this->F_LOGIN->get_form_name()]) {
			$msg = $this->F_LOGIN->process_form();
			$this->TEMPLATE_ENGINE->assign("msg", $msg);
		}

		
		// Logout-Funktion
		if ($_GET["logout"] == 1 && $_SESSION["USER"] != null) {
			$this->useCase->logout();
		}
		
		
	} // # END actions
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("F_LOGIN", $this->F_LOGIN);
			
		
	} // # END fillTemplate

}

?>