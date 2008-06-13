<?php

require_once("logic/UC.class.php");


class UCAdminBaseData extends UC {
	
	
	/** DAO für das spezifische Stammdatum */
	private $DAO;
	
	/** Welches Stammdatum wird verwaltet */
	private $baseData;
	
	
	public function UCAdminBaseData($baseData) {
		
		parent::UC(); // Aufruf Elternkonstruktor
		
		// Je nach Stammdatum richtiges DAO initialisieren
		switch ($baseData) {
			
			case "article":
				require_once("dao/DAOArticle.class.php");
				$this->DAO = new DAOArticle();
				break;
				
			case "customer":
				require_once("dao/DAOCustomer.class.php");
				$this->DAO = new DAOCustomer();
				break;
				
			case "category":
				require_once("dao/DAOCategory.class.php");
				$this->DAO = new DAOCategory();
				break;
				
			case "subcategory":
				require_once("dao/DAOSubCategory.class.php");
				$this->DAO = new DAOSubCategory();
				break;
			
		}
		
		$this->baseData = $baseData;
		
	
	} // # END UCAdminBaseData
	
	
	/**
	 * Holt aus der Datenschicht alle Einträge zum
	 * jeweiligen Stammdatum.
	 *
	 * @return array Array mit allen Stammdaten-Einträgen
	 */
	public function getAllBaseData() {
		
		switch ($this->baseData) {

			case "article":
				$allBaseData = $this->DAO->getAllArticles();				
				break;				
				
			case "customer":
				$allBaseData = $this->DAO->getAllCustomers();
				break;
				
			case "category":
				$allBaseData = $this->DAO->getAllCategories();
				break;
				
			case "subcategory":
				$allBaseData = $this->DAO->getAllSubCategoriesWithParent();
				break;
					
		}
		
		return $allBaseData;
		
		
	} // # END getAllBaseData
	
}

?>