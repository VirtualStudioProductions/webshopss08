<?php

abstract class DAO {
	
	
	/**
	 * Die Daten-Verbindung, die f�r den Datenzugriff
	 * verwendet wird
	 */
	protected $DATA_ACCESS;
	
	
	public function DAO() {
		
		global $DATA_ACCESS; // Aus index.php
		
		$this->DATA_ACCESS = $DATA_ACCESS;
		
		
	} // # END DAO
	
}

?>