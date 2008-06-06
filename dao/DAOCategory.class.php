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

		array($arr);
		$i=0;
		//gibt schön alle db inhalte zurück
		while ( $cell = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
		//print_r($cell);
		//echo("");
		$arr[$i]["name"] = $cell["name"];
		$i=$i+1; 
		}

		return $arr;
	
	} // # END getAllCategories
	
}

?>