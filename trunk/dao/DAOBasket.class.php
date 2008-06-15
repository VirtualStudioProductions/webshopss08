<?php

/**
 * Zuständig für sämtliche Operationen, bei Bestellung.
 */


require_once("DAO.class.php");



class DAOBasket extends DAO {
	
	public function getSelectedArticle(){
		
		// Index um Array zu befüllen
		$i = 0;
		
		// Alle ausgewählten Artikel werden aus der Datenbank gelesen und in $basket abgespeichert
		foreach($_SESSION["basket"] as $arNumber) {

		$sql="SELECT `ar_number`, `ar_title`, `ar_price`, `ar_stock` " .
		  "FROM " . TBL_ARTICLE . " " .
		  "WHERE `ar_number` = :arNumber;";

		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":arNumber", $arNumber);
		$stmt->execute();
		
		$article = $stmt->fetch(PDO::FETCH_ASSOC);
			
		$selectedArticle[$i] = $article;
		
		$i++;
		
		}
		
		return $selectedArticle;
	
	} // # END getSelectedArticle
	
}

?>