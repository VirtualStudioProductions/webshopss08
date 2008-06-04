<?php

require_once("UC.class.php");
require_once("dao/DAOArticle.class.php");

class UCArticle extends UC {
	
	
	/** DAO f�r die article-Tabelle */
	private $DAO;
	
	
	public function UCArticle() {
		parent::UC(); //Aufruf Elternkonstruktor
			
	}
		
	
	/** Methode um bestimmten article zu erhalten */
	public function getArticle($arNumber) {
		$DAO = new DAOArticle();
		return $DAO->getArticle($arNumber);
		
	}
}  // # END UCArticle

?>