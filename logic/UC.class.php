<?php
require_once("dao/DAOCategory.class.php");


abstract class UC {
	
	
	/** 
	 * DAO f�r die Category Tabelle
	 */
	protected $DAOCategory;
	
	//Konstruktor
	public function UC() {
		
		$this->DAOCategory = new DAOCategory();
	}
	
	
	public function listAllCategories() {
	
		return $this->DAOCategory->getAllCategories();
	
	} // # END listAllCategories
	
}
?>