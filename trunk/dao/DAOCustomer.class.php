<?php

/**
 * Zuständig für sämtliche Operationen, die auf die
 * Kunde - Tabelle des Webshops angewandt werden.
 */ 


class DAOCustomer {
	
	
	/**
	 * Ermittelt die höchste ID, die es in der Kunde - Tabelle
	 * gibt.
	 *
	 * @return Höchste ID der Kunde - Tabelle
	 */
	public function getLastID() {
		
		global $DATA_ACCESS;
		
		$query = "SELECT `cu_id` FROM `" . TBL_CUSTOMER . "` ORDER BY `cu_id` DESC LIMIT 0, 1";
		$stmt = $DATA_ACCESS->prepare($query);
		$stmt->execute();
	
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		return $result["cu_id"];
	
	} // # END getLastID
	
	
	/**
	 * Ermittelt das Passwort zu einem gegebenen Usernamen.
	 *
	 * @param String $username	Der Username, zu dem
	 * 							das Passwort gesucht werden soll.
	 * @return String			Das Passwort des Kunden (verschlüsselt).
	 */
	public function getPasswordFromUsername($username) {
		
		global $DATA_ACCESS;
		
		$query = "SELECT `cu_password` FROM `" . TBL_CUSTOMER . "` WHERE `cu_username` = :username";
		$stmt = $DATA_ACCESS->prepare($query);
		$stmt->bindValue(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		return $result["cu_password"];
		
	} // # END getPasswordFromUsername
	
	
	/**
	 * Ermittelt zu einem gegebenen Usernamen den kompletten
	 * zugehören Datensatz aus der Datenbank.
	 *
	 * @param String $username	Der Username, zu dem
	 * 							die Daten gesucht werden soll.
	 * @return Array Der Customer-Datensatz als assoziatives Array.
	 */
	public function getSpecificCustomerFromUsername($username) {
		
		global $DATA_ACCESS;
		
		$query = "SELECT * FROM `" . TBL_CUSTOMER . "` WHERE `cu_username` = :username";
		$stmt = $DATA_ACCESS->prepare($query);
		$stmt->bindValue(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		return $result;
		
	}
	
}

?>