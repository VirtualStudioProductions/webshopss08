<?php
/**
 * Zuständig für sämtliche Operationen, die auf die Kategorie-Tabelle
 * des Webshops angewandt werden.
 */ 


class DAOCategory {
	
	
	
	public function getAllCategories(){
		
		// Dummy Testarray erzeugen mit drei primitiven Kategorienamen
		// und zurückgeben des Arrays
		//$arr[0]["cat_name"] = "Kategorie 1";
		//$arr[1]["cat_name"] = "Kategorie 2";
		//$arr[2]["cat_name"] = "Kategorie 3";

	
		global $DATA_ACCESS; //Zugriff auf die DB Verbindung die in der index.php aufgebaut wird
		
		$sql="SELECT `cat_name` AS `name` " .
		  "FROM " . TBL_CATEGORY . " ";
		
		$stmt = $DATA_ACCESS->prepare($sql);
		$stmt->execute();
		//SQL fehler anzeigen:
		//print_r ($stmt->errorInfo());
		//print_r ($stmt);
		array($arr);
		$i=0;
		//gibt schön alle db inhalte zurück
		while ( $cell = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
		//print_r($cell);
		//echo("");
		$arr[$i]["name"] = $cell["name"];
		$i=$i+1; 
		}
		
		//$arr = $stmt->fetch(PDO::FETCH_ASSOC);
		//array testweise ausgeben		
		//print_r($arr);
		return $arr;
	
	} // # END getAllCategories
	
}

?>