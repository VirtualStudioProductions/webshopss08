<?php

/**
 * Zuständig für sämtliche Operationen, die auf die Artikel-Tabelle
 * des Webshops angewandt werden.
 */


require_once("DAO.class.php");


class DAOArticle extends DAO {
	
	
	public function getArticle($arNumber){
		
		$sql =
			"SELECT * " .
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
			    " WHERE `fk_sub_id` = :sub_id" . 
				" ORDER BY `ar_title` ASC"; 
	
		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":sub_id", $sub_id);
		$stmt->execute();
		
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $articles;
	
	}
	
	/**
	 * Holt alle Artikel aus der Datenbank.
	 *
	 * @return array Assoziatives Array mit allen Artikeln
	 */
	public function getAllArticles() {
		
		$query = "SELECT * FROM `" . TBL_ARTICLE . "` ORDER BY `ar_number` ASC";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->execute();
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $articles;
		
		
	} // # END getAllArticles
	
	/**
	 * Holt die neuesten Artikel aus der Datenbank.
	 *
	 * @return array Assoziatives Array mit den neuesten Artikeln
	 */
	public function getNewArticles(){

		$sql = "SELECT `ar_id`			AS `id`," . 
					  "`fk_sub_id`		AS `sub_id`," . 
					  "`ar_number`     	AS `number`," .   
					  "`ar_title`       AS `title`," .  
					  "`ar_price`       AS `price`," .      
					  "`ar_stock` 		AS `stock`," .    
					  "`ar_picture`		AS `picture`," .
					  "`fk_cat_id`		AS `cat_id`" .  
				" FROM " . TBL_ARTICLE . 
				" JOIN " . TBL_SUBCATEGORY . 
				" ON " . TBL_ARTICLE . ".fk_sub_id = " . TBL_SUBCATEGORY . ".sub_id" . 
				" WHERE `ar_stock` > 0" . 
			    " ORDER BY `ar_id` DESC" . 
				" LIMIT 0 , 4 "; //holt die 4 neuesten Artikel aus der DB, sollen mehr Artikel ausgegeben werden, kann hier das Limit verändert werden
		
		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->execute();
		
		$newarticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($newarticles);
		//print("ich werde aufgerufen");
		return $newarticles;	
	}
	
	
	
	/**
	 * Löscht einen Artikel aus der Datenbank.
	 * 
	 * @param $ar_id	Die ID des Artikels, der gelöscht werden
	 * 					soll
	 *
	 * @return bool		Wahrheitswert, ob der Datensatz gelöscht
	 * 					wurde
	 */
	public function deleteArticle($ar_id) {
		
		$article = $this->getArticle($ar_id);
		
		$query = "DELETE FROM `" . TBL_ARTICLE . "` " .
					"WHERE `ar_id` = :ar_id";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->bindValue(":ar_id", $ar_id, PDO::PARAM_INT);
		$deleted = $stmt->execute();
		unlink("presentation/images/article/" . $article["ar_picture"]);
		
		return $deleted;
		
		
	} // # END deleteArticle
	
}

?>