<?php

require_once("dao/DAOCategory.class.php");
require_once("dao/DAOTrace.class.php");


class UC {
	
	
	/** 
	 * DAO für die Category Tabelle
	 */
	protected $DAOCategory;
	
	/** 
	 * DAO für die Trace Tabelle
	 */
	protected $DAOTrace;
	
	
	// Konstruktor
	public function UC() {
		
		$this->DAOCategory	= new DAOCategory();
		$this->DAOTrace		= new DAOTrace();
		
		// Besucher verfolgen, aber nur falls dieser
		// Cookies aktiviert hat
		if ($_COOKIE["webshoptest"] != "") {
			$this->traceUser();
		}
		
		// Traces, die den Timeout überschritten haben, löschen
		$this->DAOTrace->deleteTimedOutTraces();
		
	} // # END UC
	
	
	/**
	 * Verfolgt den Besucher. Protokolliert, wann welche Besucher
	 * den Shop besuchen und speichert, auf welchen Seiten diese
	 * sich rumtreiben.
	 */
	private function traceUser() {
		
		// Trace - Informationen ermitteln

		if ($_COOKIE["webshoptrace"] != "") {
			$identifier = $_COOKIE["webshoptrace"];
		}
		else {
			// Identifier erzeugen
			$id_unix = time();
			$id_date = date("l dS of F Y h:i:s A");			
			$identifier = md5($id_unix . $id_date);
		}
		
		$date = date("y.m.d");
		$time = date("H:i:s");
		$site = $_GET["site"];
		
		
		// Cookie setzen bzw. aktualisieren
		setcookie("webshoptrace", $identifier, time() + 60 * 60 * 24 *30);
				
		
		// Trace speichern
		$this->DAOTrace->insertNewTrace($identifier, $date, $time, $site);
		
	} // # END traceUser
	
	
	public function listAllCategories() {
	
		return $this->DAOCategory->getAllCategories();
	
	} // # END listAllCategories

	//braucht den Kategorienamen um die Unterkategorien zurückliefern zu können. Zirkelschluss? ->in DTO verlagern?
	public function listAllSubCategories($c_name) {
	
	return $this->DAOCategory->getSelectedSubcategories($c_name);
	
	} // # END listAllSubCategories
	
	
}
?>