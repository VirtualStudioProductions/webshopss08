<?php

require_once("UC.class.php");
require_once("dao/DAOBasket.class.php");

class UCBasket extends UC {
	
	
	/** DAO für die article-Tabelle */
	private $DAO;
	
	
	public function UCBasket() {
		parent::UC(); //Aufruf Elternkonstruktor
			
	}
		
	
	/** Methode um bestimmten article zu erhalten */
	public function getBasket($arNumber) {
		$DAO = new DAOBasket();
		return $DAO->getBasket($arNumber);
		
	}
}  // # END UCArticle

?>