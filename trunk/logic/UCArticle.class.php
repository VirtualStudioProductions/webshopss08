<?php

require_once("UC.class.php");
require_once("dao/DAOArticle.class.php");

class UCArticle extends UC {
	
	
	/** DAO für die article-Tabelle */
	private $DAO;
	
	
	public function UCArticle() {
		
		parent::UC(); //Aufruf Elternkonstruktor
		
		# Session-Warenkorb Array anlegen (falls nicht vorhanden)
		if($_SESSION["basket"] != null) {
			
		}
		
		$this->DAO = new DAOArticle();
			
	} // # END UCArticle
	
	
	public function getCatFromSub($sub) {

		return $this->DAO->getCatFromSub($sub);
		
	} // # END getCatFromSub
		
	
	/** Methode um bestimmten article zu erhalten */
	public function getArticle($arNumber) {
		
		return $this->DAO->getArticle($arNumber);
		
	} // # END getArticle

}

?>