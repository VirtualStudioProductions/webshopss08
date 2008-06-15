<?php

/**
 * Zuständig für sämtliche Operationen, die auf die Artikel-Tabelle
 * des Webshops angewandt werden.
 */


require_once("DAO.class.php");


class DAOArticle extends DAO {
	
	
	public function getArticle($arNumber){
		
		$sql="SELECT `ar_number`, `ar_title`, `ar_price`, `ar_description`, `ar_stock` " .
		  "FROM " . TBL_ARTICLE . " " .
		  "WHERE `ar_number` = :arNumber;";

		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":arNumber", $arNumber);
		$stmt->execute();
		
		$article = $stmt->fetch(PDO::FETCH_ASSOC);

		return $article;
	
	} // # END getArticle
	
	
	/**
	 * liefert alle Artikel einer UnterKategorie zurück. Diese werden im Main Window angezeigt sobald der User auf eine Unterkategorien klickt
	 * evtl könnt man hier auch die Anzahl der zurückgegebenen Artikel begrenzen und dann mehrere Seiten draus machn
	 * @param Int $subcategory_id 
	 */
	public function getAllSubCategoryArticles($sub_id){
	
		$sql = "SELECT `ar_number`     	AS `number`," .   
					  "`ar_title`       AS `title`," .  
					  "`ar_price`       AS `price`," .   
					  "`ar_description` AS `description`," .   
					  "`ar_stock` 		AS `stock`" .    
				" FROM " . TBL_ARTICLE . 
			    " WHERE `fk_sub_id` = :sub_id"; 
	
		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":sub_id", $sub_id);
		$stmt->execute();
		
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $articles;
	
	}
	
}

?>