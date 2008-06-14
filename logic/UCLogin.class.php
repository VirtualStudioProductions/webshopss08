<?php

require_once("dao/DAOCustomer.class.php");
require_once("UC.class.php");


class UCLogin extends UC {
	
	
	/** DAO für die Kunde - Tabelle */
	private $DAOCustomer;
	
	/** Login - Formular */
	private $F_LOGIN;
	
	
	public function UCLogin() {
		
		parent::UC(); // Aufruf Elternkonstruktor
		$this->DAOCustomer = new DAOCustomer();
		$this->F_LOGIN = $this->createLoginForm();
	
	} // # END UCLogin
	
	
	public function createLoginForm() {
		
		// Datenbankverbindung sichtbar machen mit global
		global $DATA_ACCESS;
		
		
		// Login Formular erzeugen
		$F_LOGIN = new Form(
							"login",
							FORM_LAYOUT_DIR,
							array("username", "password"),
							"",
							"",
							"",
							"replacement",		// Standard-Formular-Verarbeitung wird mit eigener ersetzt
							$this,				// Dieser UC ist der Eigentümer des Formulares
							$DATA_ACCESS);
		
		// Formular-Eigenschaften
		$F_LOGIN->set_show_reset_button(false);			// Reset Button ausschalten
		$F_LOGIN->set_submit_value("Login!");			// Text des Submit Buttons
		
		// Zu Beginn fokusiertes Feld festlegen
		$F_LOGIN->set_focus_field("username");
		
		
		// Formular Felder hinzufügen
		
		// Username
		$FIELD = new TextField("username", "Username", " class=\"textField\"");
		$FIELD->set_v_required(true);		// Pflichtfeld
		$FIELD->set_v_isunique(true);		// Einzigartig
		$FIELD->set_v_nospace(true);		// Keine Leerzeichen
		$FIELD->set_v_nospecial(true);		// Keine Sonderzeichen
		$FIELD->set_v_nosql(true);			// Keine SQL Dingens
		$F_LOGIN->add_field($FIELD);
		
		// Passwort
		$FIELD = new PasswordField("password", "Passwort", " class=\"textField\"");
		$FIELD->set_v_required(true);
		$FIELD->set_v_nospace(true);
		$FIELD->set_v_minlength(6);			// Mindestens 6 Zeichen
		$F_LOGIN->add_field($FIELD);
	
		
		return $F_LOGIN;
		
	
	} // # END createLoginForm
	
	
	/**
	 * Loggt den User aus dem System aus.
	 */
	public function logout() {
		
		$_SESSION["USER"] = null;
		header("Location: " . $_SERVER["PHP_SELF"] . "?site=startpage&handheld=" . $_GET["handheld"]);
	
	} // # END logout
	
	
	/**
	 * Gibt zurück, ob der Login erfolgreich war.
	 *
	 * @return boolean 
	 */
	private function authentificate() {
		
		$loginSuccess = false;
	
		// Ermittle Passwort
		$DBPass = $this->DAOCustomer->getPasswordFromUsername($_POST["username"]);
		$cryptedInputPass = crypt($_POST["password"], $DBPass);
		
		// Gleiche Passwort mit Datenbank ab
		if ($DBPass == $cryptedInputPass) {
			$_SESSION["USER"] = $this->DAOCustomer->getSpecificCustomerFromUsername($_POST["username"]);
			$loginSuccess = true;
		}
		
		return $loginSuccess;
		
	} // # END authentificate
	
	
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
		
		// Eigene Formular-Verarbeitung für den Login
		
		
		// Mache alles nur, falls der User nicht bereits eingeloggt ist
		if ($_SESSION["USER"] != null) {
			return $msg;
		}
		
		
		$errorStr = "<strong>Login inkorrekt!</strong>";
		
		// Wurden die Felder ordnungsgemäß ausgefüllt?
		// Wenn nein, dann breche gleich ab!
		$msg = $this->F_LOGIN->validate_data();
		if ($msg["valid"] == false) {
			$msg["general_error"] = $errorStr;
		}
		// Sonst versuche Authentifizierung
		else {
		
			if ($this->authentificate() == false) {
				$msg["general_error"] = $errorStr;
				$msg["valid"] = false;
			}
			else {
				// Weiterleiten um nervigen Dialog des Browsers bei Refresh zu vermeiden
				$this->F_LOGIN->redirectOnValid($msg);
			}
			
		}
		

		return $msg;
		
		
	} // # END process_form
	
}

?>