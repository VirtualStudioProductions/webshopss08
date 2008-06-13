<?php

/**
 * Zuständig für sämtliche Operationen, die auf die
 * Kunde - Tabelle des Webshops angewandt werden.
 */


require_once("DAO.class.php");


class DAOCustomer extends DAO {
	
	
	/**
	 * Ermittelt die höchste ID, die es in der Kunde - Tabelle
	 * gibt.
	 *
	 * @return Höchste ID der Kunde - Tabelle
	 */
	public function getLastID() {
		
		$query = "SELECT `cu_id` FROM `" . TBL_CUSTOMER . "` ORDER BY `cu_id` DESC LIMIT 0, 1";
		$stmt = $this->DATA_ACCESS->prepare($query);
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
		
		$query = "SELECT `cu_password` FROM `" . TBL_CUSTOMER . "` WHERE `cu_username` = :username";
		$stmt = $this->DATA_ACCESS->prepare($query);
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
		
		$query = "SELECT * FROM `" . TBL_CUSTOMER . "` WHERE `cu_username` = :username";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->bindValue(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		return $result;
		
		
	} // # END getSpecificCustomerFromUsername
	
	
	/**
	 * Holt alle Kunden aus der Datenbank.
	 *
	 * @return array Assoziatives Array mit allen Kunden
	 */
	public function getAllCustomers() {
		
		$query = "SELECT * FROM `" . TBL_CUSTOMER . "` ORDER BY `cu_number` ASC";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->execute();
		$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $customers;
		
		
	} // # END getAllCustomers
	
}

?>