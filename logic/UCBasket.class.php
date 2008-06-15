<?php

require_once("UC.class.php");
require_once("dao/DAOBasket.class.php");

class UCBasket extends UC {
	
	
	/** DAO f�r die article-Tabelle */
	private $DAO;
	
	
	public function UCBasket() {
		parent::UC(); //Aufruf Elternkonstruktor
			
	}
		
	
	/** Methode um bestimmten article zu erhalten */
	public function getselectedArticle() {
		$DAO = new DAOBasket();
		return $DAO->getselectedArticle();
		
	}
}  // # END UCArticle

?>