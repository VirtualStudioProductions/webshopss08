<?php

require_once("dao/DAOCustomer.class.php");
require_once("UC.class.php");


class UCRegistration extends UC {
	
	
	/** DAO f�r die Kunde - Tabelle */
	private $DAOCustomer;
	
	
	public function UCRegistration() {
		
		parent::UC(); // Aufruf Elternkonstruktor
		$this->DAOCustomer = new DAOCustomer();
	
	} // # END UCRegistration
	
	
	public function createRegistrationForm() {

		// Datenbankverbindung sichtbar machen mit global
		global $DATA_ACCESS;
				
		
		// Registration Formular erzeugen
		$FORM = new Form(
						"registration",
						FORM_LAYOUT_DIR,
						array("cu_username", "cu_password", "cu_firstname",
								"cu_lastname", "cu_phone", "cu_email", "cu_number"),
						TBL_CUSTOMER,
						"",					// keine WHERE Klausel n�tig
						"cu_id",
						"extention",		// Eigene Formular-Verarbeitung wird angeh�ngt
						$this,				// Dieser UC ist der Eigent�mer des Formulares
						$DATA_ACCESS);
				
		// Formular-Eigenschaften
		$FORM->set_show_reset_button(false);				// Reset Button ausschalten
		$FORM->set_submit_value("Jetzt registrieren!");		// Text des Submit Buttons
				
		// Best�tigung bei Erfolg anzeigen lassen
		$FORM->set_confirmation_on_success(true);
				
		// Zu Beginn fokusiertes Feld festlegen
		$FORM->set_focus_field("cu_username");
		
				
		// Formular Felder hinzuf�gen
		
		// Username
		$FIELD = new TextField("cu_username", "Username", " class=\"textField\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_isunique(true);		// Einzigartig
		$FIELD->set_v_nospace(true);		// Keine Leerzeichen
		$FIELD->set_v_nospecial(true);		// Keine Sonderzeichen
		$FIELD->set_v_minlength(6);
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
		
		// Passwort
		$FIELD = new PasswordField("cu_password", "Passwort", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_minlength(6);			// Mindestens 6 Zeichen
		$FIELD->set_v_maxlength(50);
		$FIELD->set_crypt(true);			// Verschl�sseln
		$FORM->add_field($FIELD);
		
		// Vorname
		$FIELD = new TextField("cu_firstname", "Vorname", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
			
		// Nachname
		$FIELD = new TextField("cu_lastname", "Nachname", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
		
		// E-Mail
		$FIELD = new TextField("cu_email", "E-Mail", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_email(true);			// G�ltige E-Mail Adresse
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
		
		// Telefon
		$FIELD = new TextField("cu_phone", "Telefon", " class=\"textField\"", 20);
		$FIELD->set_v_maxlength(20);		// Maximal 20 Zeichen
		$FORM->add_field($FIELD);
		
		// Kundennummer
		$FIELD = new HiddenField("cu_number", $this->computeCustomerNumber());
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_required(true);
		$FIELD->set_v_maxlength(10);
		$FORM->add_field($FIELD);
		
		
		return $FORM;
		
	
	} // # END createRegistrationForm
	
	
	/**
	 * Baut die Kundennummer f�r den neuen Kunden zusammen.
	 *
	 * @return Eine eindeutige Kundennummer
	 */
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
	
	
	/**
	 * Diese Methode erweitert die Standard-Formular-Verarbeitung
	 * der Form-API. Es ist dabei wichtig, dass diese Methode
	 * process_form hei�t und eine $msg �bergeben bekommt. Diese $msg
	 * kann per Default auf ein leeres Array gesetzt werden.
	 * 
	 * Diese Methode wird nur aufgerufen, wenn beim Formular-Konstruktor
	 * bei CUSTOM_TYPE entweder "extention" oder "replacement" angegeben
	 * wurde und das OWNER_OBJECT dieser UC ist.
	 *
	 * @param $msg		F�r Fehler-Tracking
	 * @return $msg
	 */
	public function process_form($msg = array()) {
		
		// Erweiterte Formular-Verarbeitung f�r die Registrierung
		
		
		// E-Mail versenden
		if (SEND_EMAILS == true) {
			
			$mail["to"]			= $_POST["cu_email"];
			$mail["subject"]	= PAGE_TITLE . " Registration";
					
			$mail["message"] = "".$_POST["cu_username"].", willkommen bei " . PAGE_TITLE . "\n";
			$mail["message"] .= "Dein Account wurde registriert.\n\n";
			$mail["message"] .= "Wichtig: Diese E-Mail wurde dir automatisch zugesandt, bitte nicht antworten!";
				
			$mail["headers"] = "From: " . EMAIL . "\n";										
					
			$send = mail($mail["to"], $mail["subject"], $mail["message"], $mail["headers"]);
		
		}

		return $msg;
		
		
	} // # END process_form
	
}

?>