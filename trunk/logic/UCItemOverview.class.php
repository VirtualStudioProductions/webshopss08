<?php

require_once("dao/DAOItem.class.php");
require_once("UC.class.php");

class UCItemOverview extends UC{
	
	
	/** DAO f�r die item Tabelle */
	private $DAOItem;
	
	
	public function UCItemOverview() {
		parent::UC(); //Aufruf des Elternkonstruktors
		//$this->DAOItem = DAOItem::getInstance(); //alter Aufruf passend f�r das Singleton Muster
		$this->DAOItem = new DAOItem();
		
	} // # END UCItemOverview
	
	
	public function listAllItems() {
	
		return $this->DAOItem->getAllItems();
	
	} // # END listAllItems
	
}

?>