<?php
require_once("UC.class.php");
require_once("dao/DAOArticle.class.php");

class UCStartpage extends UC {
	
	/** DAO für das Array mit allen Artikeln der Unterkategorie*/
	private $DAO;
	
	
	public function UCStartpage() {
		parent::UC(); //Aufruf des Elternkonstruktors
			
	}
		
	
	/** Methode um neue Artikel zu erhalten */
	public function listNewArticles() {
		$DAO = new DAOArticle();
		return $DAO->getNewArticles();
		
	}
	
}
?>