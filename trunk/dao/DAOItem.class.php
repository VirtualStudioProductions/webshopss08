<?php

/**
 * Zuständig für sämtliche Operationen, die auf die Artikel-Tabelle
 * des Webshops angewandt werden.
 */ 



class DAOItem {
	
	
	public function getAllItems(){
		
		// DB-Zugriff wird hier noch implementiert!
		
		// Dummy Testarray erzeugen mit zwei primitiven Artikeln
		// und zurückgeben des Arrays
		$arr[0]["bez"] = "Artikel 1";
		$arr[1]["bez"] = "Artikel 2";

		return $arr;
	
	} // # END getAllItems
	
}

?>