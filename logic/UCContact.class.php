<?php

require_once("UC.class.php");


class UCContact extends UC {
	
	
	/** Kontakt - Formular */
	private $F_CONTACT;
	
	
	public function UCContact() {
		
		parent::UC(); // Aufruf Elternkonstruktor
		$this->F_CONTACT = $this->createContactForm();
	
		
	} // # END UCContact
	
	
	public function createContactForm() {
		
		// Datenbankverbindung sichtbar machen mit global
		global $DATA_ACCESS;
		
		
		// Kontakt Formular erzeugen
		$FORM = new Form(
						"contact",
						FORM_LAYOUT_DIR,
						array("name", "email", "homepage",
							"phone", "subject", "message"),
						"",
						"",
						"",
						"replacement",		// Standard-Formular-Verarbeitung wird mit eigener ersetzt
						$this,				// Dieser UC ist der Eigentümer des Formulares
						$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$FORM->set_show_reset_button(false);			// Reset Button ausschalten
		$FORM->set_submit_value("Abschicken!");		// Text des Submit Buttons
		
		// Bestätigung bei Erfolg anzeigen lassen
		$FORM->set_confirmation_on_success(true);
		
		// Zu Beginn fokusiertes Feld festlegen
		$FORM->set_focus_field("name");
		
		
		// Formular Felder hinzufügen
		
		// Name
		$FIELD = new TextField("name", "Name", " class=\"textField\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_nospecial(true);		// Keine Sonderzeichen
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
		
		// E-Mail
		$FIELD = new TextField("email", "E-Mail", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_email(true);			// Gültige E-Mail Adresse
		$FIELD->set_v_maxlength(50);
		$FORM->add_field($FIELD);
		
		// Homepage
		$FIELD = new TextField("homepage", "Homepage", " class=\"textField\"");
		$FIELD->set_v_maxlength(100);
		$FIELD->set_v_link(true);			// Gültiger Link
		$FORM->add_field($FIELD);
		
		// Telefon
		$FIELD = new TextField("phone", "Telefon", " class=\"textField\"", 20);
		$FIELD->set_v_maxlength(20);		// Maximal 20 Zeichen
		$FORM->add_field($FIELD);
		
		// Betreff
		$FIELD = new TextField("subject", "Betreff", " class=\"textField\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_maxlength(75);
		$FORM->add_field($FIELD);
		
		// Nachricht
		$FIELD = new TextArea("message", "Nachricht", "", 8, 40);
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FORM->add_field($FIELD);
		
		
		return $FORM;
		
	
	} // # END createContactForm
	
	
	/**
	 * Diese Methode ersetzt die Standard-Formular-Verarbeitung
	 * der Form-API. Es ist dabei wichtig, dass diese Methode
	 * process_form heißt und eine $msg übergeben bekommt. Diese $msg
	 * kann per Default auf ein leeres Array gesetzt werden.
	 * 
	 * Diese Methode wird nur aufgerufen, wenn beim Formular-Konstruktor
	 * bei CUSTOM_TYPE entweder "extention" oder "replacement" angegeben
	 * wurde und das OWNER_OBJECT dieser UC ist.
	 *
	 * @param $msg		Für Fehler-Tracking
	 * @return $msg
	 */
	public function process_form($msg = array()) {
		
		// Eigene Formular-Verarbeitung für den Kontakt
		
		
		$msg = $this->F_CONTACT->validate_data();
		
		
		// E-Mail versenden
		if (SEND_EMAILS == true && $msg["valid"]) {
			
			$mail["to"]			= EMAIL;
			$mail["subject"]	= $_POST["subject"];
				
			$mail["message"] = "Das Kontakt-Formular von " . PAGE_TITLE
								. " wurde mit folgenden Eingaben abgeschickt:\n\n";
								
			$mail["message"] .= "Name: " . $_POST["name"] . "\n";
			$mail["message"] .= "E-Mail: " . $_POST["email"] . "\n";
			$mail["message"] .= "Homepage: " . $_POST["homepage"] . "\n";
			$mail["message"] .= "Telefon: " . $_POST["phone"] . "\n\n";
			
			$mail["message"] .= "Betreff: " . $_POST["subject"] . "\n\n";
			
			$mail["message"] .= "Nachricht:\n\n" . $_POST["message"];
			
				
			$mail["headers"] = "From: " . $_POST["email"] . "\n";										
					
			$send = mail($mail["to"], $mail["subject"], $mail["message"], $mail["headers"]);
		
		}
		
		// Weiterleiten um nervigen Dialog des Browsers bei Refresh zu vermeiden
		$this->F_CONTACT->redirectOnValid($msg);
		

		return $msg;
		
		
	} // # END process_form
	
}

?>