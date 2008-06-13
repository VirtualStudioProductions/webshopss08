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
	 * liefert alle Artikel einer Kategorie zurück. Diese werden im Main Window angezeigt sobald der User auf eine der Kategorien klickt
	 * evtl könnt man hier auch die Anzahl der zurückgegebenen Artikel begrenzen und dann mehrere Seiten draus machn
	 * @param String $category 
	 */
	public function getAllCategoryArticles($category){
		
		
	} // # END getAllCategoryArticles
	
	
	/**
	 * liefert alle Artikel einer UnterKategorie zurück. Diese werden im Main Window angezeigt sobald der User auf eine Unterkategorien klickt
	 * evtl könnt man hier auch die Anzahl der zurückgegebenen Artikel begrenzen und dann mehrere Seiten draus machn
	 * @param String $subcategory 
	 */
	public function getAllSubCategoryArticles($subcategory){
		
		
	} // # END getAllSubCategoryArticles
	
	
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
	
}

?>