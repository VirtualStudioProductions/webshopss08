<?php
/**
 * Zuständig für sämtliche Operationen, die auf die Kategorie-Tabelle
 * des Webshops angewandt werden.
 */ 


class DAOCategory {
	
	
	
	public function getAllCategories(){
		
		// DB-Zugriff wird hier noch implementiert!
		
		// Dummy Testarray erzeugen mit drei primitiven Kategorienamen
		// und zurückgeben des Arrays
		$arr[0]["name"] = "Kategorie 1";
		$arr[1]["name"] = "Kategorie 2";
		$arr[2]["name"] = "Kategorie 3";

		return $arr;
	
	} // # END getAllCategories
	
}

?>