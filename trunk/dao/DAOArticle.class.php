<?php

/**
 * Zust�ndig f�r s�mtliche Operationen, die auf die Artikel-Tabelle
 * des Webshops angewandt werden.
 */ 

require_once("config.inc.php");

class DAOArticle {
	
	
	public function getArticle($arNumber){
		
		global $DATA_ACCESS;
					
		$sql="SELECT `ar_number`, `ar_title`, `ar_price`, `ar_description`, `ar_stock` " .
		  "FROM " . TBL_ARTICLE . " " .
		  "WHERE `ar_number` = :arNumber;";

		$stmt = $DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":arNumber", $arNumber);
		$stmt->execute();
		
		$article = $stmt->fetch(PDO::FETCH_ASSOC);

		return $article;
	
	} // # END getArticle
	
	
	/**
	 * liefert alle Artikel einer Kategorie zur�ck. Diese werden im Main Window angezeigt sobald der User auf eine der Kategorien klickt
	 * evtl k�nnt man hier auch die Anzahl der zur�ckgegebenen Artikel begrenzen und dann mehrere Seiten draus machn
	 * @param String $category 
	 */
	public function getAllCategoryArticles($category){
		
		
	}
	
	/**
	 * liefert alle Artikel einer UnterKategorie zur�ck. Diese werden im Main Window angezeigt sobald der User auf eine Unterkategorien klickt
	 * evtl k�nnt man hier auch die Anzahl der zur�ckgegebenen Artikel begrenzen und dann mehrere Seiten draus machn
	 * @param String $subcategory 
	 */
	public function getAllSubCategoryArticles($subcategory){
		
		
	}
	
}

?>