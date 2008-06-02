<?php

/**
 * Zuständig für sämtliche Operationen, die auf die Artikel-Tabelle
 * des Webshops angewandt werden.
 */ 

require_once("config.inc.php");

class DAOArticle {
	
	
	public function getArticle($arNumber){
		
		$DATA_ACCESS = new PDO(
					"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
					DB_USER,
					DB_PASS,
					array(
					PDO::ATTR_PERSISTENT => true
					));
					
		$sql="SELECT `ar_number`, `ar_title`, `ar_price`, `ar_description`, `ar_stock`, `ar_picture` " .
		  "FROM " . TBL_ARTICLE . " " .
		  "WHERE `ar_number` = :arNumber;";

		$stmt = $DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":arNumber", $arNumber);
		$stmt->execute();
		
		$article = $stmt->fetch(PDO::FETCH_ASSOC);

		return $article;
	
	} // # END getArticle
	
}

?>