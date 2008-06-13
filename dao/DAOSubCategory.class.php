<?php
/**
 * Zuständig für sämtliche Operationen, die auf die Unter-Kategorie-Tabelle
 * des Webshops angewandt werden.
 */


require_once("DAO.class.php");


class DAOSubCategory extends DAO {
	

	/**
	 * Holt alle Unter-Kategorien aus der Datenbank,
	 * inklusive deren Eltern-Kategorien.
	 *
	 * @return array Assoziatives Array mit allen Unter-Kategorien
	 */
	public function getAllSubCategoriesWithParent() {
		
		$query =
			"SELECT * " .
			"FROM `" . TBL_SUBCATEGORY . "` AS SC " .
			"	JOIN `" . TBL_CATEGORY . "` AS C " .
			"		ON SC.fk_cat_id = C.cat_id " .
			"ORDER BY C.cat_name ASC";
		
		print $query;
		
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->execute();
		$subCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $subCategories;
		
		
	} // # END getAllSubCategoriesWithParent
	
}

?>