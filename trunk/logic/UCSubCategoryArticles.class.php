<?php

require_once("UC.class.php");
require_once("dao/DAOCategory.class.php");
require_once("dao/DAOArticle.class.php");

class UCSubCategoryArticles extends UC {
	
	
	/** DAO für das Array mit allen Artikeln der Unterkategorie*/
	private $DAO;
	
	
	public function UCSubCategoryArticles() {
		parent::UC(); //Aufruf des Elternkonstruktors
			
	}
		
	
	/** Methode um bestimmten article zu erhalten */
	public function getSubCategoryArticles($sub_id) {
		$DAO = new DAOArticle();
		return $DAO->getAllSubCategoryArticles($sub_id);
		
	}
}  // # END UCArticle

?>