<?php
/**
 * Zuständig für sämtliche Operationen, die auf die Kategorie-Tabelle
 * des Webshops angewandt werden.
 */ 


class DAOCategory {
	
	
	
	public function getAllCategories(){
	
		global $DATA_ACCESS; //Zugriff auf die DB Verbindung die in der index.php aufgebaut wird
		
		$sql="SELECT `cat_name` AS `name` " .
		  "FROM " . TBL_CATEGORY . " ORDER BY `cat_name` ASC ";
		
		$stmt = $DATA_ACCESS->prepare($sql);
		$stmt->execute();
		//alle Spalteneinträge in Array $arr schreiben
		$arr = $stmt->fetchAll( PDO::FETCH_ASSOC );
		return $arr;
	
	} // # END getAllCategories
	
}

?>