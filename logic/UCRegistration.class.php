<?php

//require_once("dao/DAOItem.class.php");
require_once("UC.class.php");

class UCRegistration extends UC{
	
	
	/** DAO für die item Tabelle */
	//private $DAOItem;
	
	
	public function UCRegistration() {
		parent::UC(); //Aufruf Elternkonstruktor
		//$this->DAOItem = DAOItem::getInstance();
	
	} // # END UCRegistration
	
	
	public function createRegistrationForm() {
		
		// Datenbankverbindung sichtbar machen mit global
		global $DATA_ACCESS;
		
		
		// Registration Formular erzeugen
		$F_REGISTRATION = new Form(
							"registration",
							array("username", "passwort", "vorname",
							"nachname", "telefon", "email"),
							TBL_KUNDEN,
							"",		// keine WHERE Klausel nötig
							"id",
							"",		// kein Custom Type nötig
							"",		// keine Owner Site nötig
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_REGISTRATION->set_show_reset_button(false);			// Reset Button ausschalten
		$F_REGISTRATION->set_submit_value("Registrieren!");		// Text des Submit Buttons
		$F_REGISTRATION->set_css(" class=\"form\"");			// CSS für das Formular
		$F_REGISTRATION->set_submit_css(" class=\"submit\"");	// CSS für Submit-Button
		
		// action Attribut des form Elementes überschreiben
		$F_REGISTRATION->set_action($_SERVER["PHP_SELF"] . "?site=" . $_GET["site"]);
		
		// Automatische Weiterleitung ausschalten
		$F_REGISTRATION->set_redirect(false);
		
		
		// Formular Felder hinzufügen
		
		// Username
		$FIELD = new TextField("username", "Username", " class=\"textfield\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_isunique(true);		// Einzigartig
		$FIELD->set_v_nospace(true);		// Keine Leerzeichen
		$FIELD->set_v_nospecial(true);		// Keine Sonderzeichen
		$FIELD->set_v_nosql(true);			// Keine SQL Dingens
		$FIELD->set_process_field(true);	// Verarbeiten lassen
		$F_REGISTRATION->add_field($FIELD);
		
		// Passwort
		$FIELD = new PasswordField("passwort", "Passwort", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_minlength(6);			// Mindestens 6 Zeichen
		$FIELD->set_process_field(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// Vorname
		$FIELD = new TextField("vorname", "Vorname", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_process_field(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// Nachname
		$FIELD = new TextField("nachname", "Nachname", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_process_field(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// E-Mail
		$FIELD = new TextField("email", "E-Mail", " class=\"textfield\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_isunique(true);
		$FIELD->set_v_email(true);			// Gültige E-Mail Adresse
		$FIELD->set_process_field(true);
		$F_REGISTRATION->add_field($FIELD);
		
		// Telefon
		$FIELD = new TextField("telefon", "Telefon", " class=\"textfield\"", 20);
		$FIELD->set_v_maxlength(20);		// Maximal 20 Zeichen
		$FIELD->set_process_field(true);
		$F_REGISTRATION->add_field($FIELD);
	
		
		return $F_REGISTRATION;
		
	
	} // # END createRegistrationForm
	
}

?>