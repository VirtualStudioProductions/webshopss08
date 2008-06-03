<?php

require_once("dao/DAOCustomer.class.php");
require_once("UC.class.php");

class UCRegistration extends UC {
	
	
	/** DAO für die Kunde - Tabelle */
	private $DAOCustomer;
	
	
	public function UCRegistration() {
		
		parent::UC(); //Aufruf Elternkonstruktor
		$this->DAOCustomer = new DAOCustomer();
	
	} // # END UCRegistration
	
	
	public function createRegistrationForm() {
		
		// Datenbankverbindung sichtbar machen mit global
		global $DATA_ACCESS;
		
		
		// Registration Formular erzeugen
		$F_REGISTRATION = new Form(
							"registration",
							array("cu_username", "cu_password", "cu_firstname",
							"cu_lastname", "cu_phone", "cu_email", "cu_number"),
							TBL_CUSTOMER,
							"",					// keine WHERE Klausel nötig
							"id",
							"extention",		// Eigene Formular-Verarbeitung wird angehängt
							$this,				// Dieser UC ist der Eigentümer des Formulares
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_REGISTRATION->set_show_reset_button(false);			// Reset Button ausschalten
		$F_REGISTRATION->set_submit_value("Registrieren!");		// Text des Submit Buttons
		$F_REGISTRATION->set_css(" class=\"form\"");			// CSS für das Formular
		$F_REGISTRATION->set_submit_css(" class=\"submit\"");	// CSS für Submit-Button
		
		// action Attribut des form Elementes überschreiben
		$F_REGISTRATION->set_action($_SERVER["PHP_SELF"] . "?site=" . $_GET["site"]);
		
		// Automatische Weiterleitung ausschalten
		$F_REGISTRATION->set_redirect_url("?site=".$_GET["site"]."&confirm=true");
		
		
		// Formular Felder hinzufügen
		
		// Username
		$FIELD = new TextField("cu_username", "Username", " class=\"textfield\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_isunique(true);		// Einzigartig
		$FIELD->set_v_nospace(true);		// Keine Leerzeichen
		$FIELD->set_v_nospecial(true);		// Keine Sonderzeichen
		$FIELD->set_v_nosql(true);			// Keine SQL Dingens
		$F_REGISTRATION->add_field($FIELD);
		
		// Passwort
		$FIELD = new PasswordField("cu_password", "Passwort", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_minlength(6);			// Mindestens 6 Zeichen
		$FIELD->set_crypt(true);			// Verschlüsseln
		$F_REGISTRATION->add_field($FIELD);
		
		// Vorname
		$FIELD = new TextField("cu_firstname", "Vorname", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// Nachname
		$FIELD = new TextField("cu_lastname", "Nachname", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// E-Mail
		$FIELD = new TextField("cu_email", "E-Mail", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_email(true);			// Gültige E-Mail Adresse
		$F_REGISTRATION->add_field($FIELD);
		
		// Telefon
		$FIELD = new TextField("cu_phone", "Telefon", " class=\"textfield\"", 20);
		$FIELD->set_v_maxlength(20);		// Maximal 20 Zeichen
		$F_REGISTRATION->add_field($FIELD);
		
		// Kundennummer
		$FIELD = new HiddenField("cu_number", $this->computeCustomerNumber());
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(10);
		$F_REGISTRATION->add_field($FIELD);
	
		
		return $F_REGISTRATION;
		
	
	} // # END createRegistrationForm
	
	
	private function computeCustomerNumber() {
		
		$lastID = $this->DAOCustomer->getLastID();
		$number = $lastID + 1;
		
		if ($number < 10)
			$zeros = "000000";
		else if ($number >= 10 && $number < 100)
			$zeros = "00000";
		else if ($number >= 100 && $number < 1000)
			$zeros = "0000";
		else if ($number >= 1000 && $number < 10000)
			$zeros = "000";
		else if ($number >= 10000 && $number < 100000)
			$zeros = "00";
		else if ($number >= 100000 && $number < 1000000)
			$zeros = "0";
		else
			$zeros = "";
			
	
		return "WS_". $zeros . $number;
		
	} // # END computeCustomerNumber
	
	
	public function process_form($msg = "") {
		
		// Erweiterte Formular-Verarbeitung für die Registrierung
		
		
		// E-Mail versenden
		if (OFFLINE_MODE == false) {
			
			$mail["to"]			= $_POST["cu_email"];
			$mail["subject"]	= PAGE_TITLE . " Registration";
					
			$mail["message"] = "".$_POST["cu_username"].", willkommen bei " . PAGE_TITLE . "\n";
			$mail["message"] .= "Dein Account wurde registriert. Du musst ihn allerdings noch aktivieren.\n\n";
			$mail["message"] .= "Verwende diesen Link, um deinen Account zu aktivieren:\n";
			$mail["message"] .= "link\n";
			$mail["message"] .= "Wichtig: Diese E-Mail wurde dir automatisch zugesandt, bitte nicht antworten!";
				
			$mail["headers"] = "From: " . MAIL_FROM . "\n";										
					
			$send = mail($mail["to"], $mail["subject"], $mail["message"], $mail["headers"]);
		
		}

		return $msg;
		
		
	} // # END process_form
	
}

?>