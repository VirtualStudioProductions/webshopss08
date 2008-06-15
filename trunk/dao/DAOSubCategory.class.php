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
		
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->execute();
		$subCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $subCategories;
		
		
	} // # END getAllSubCategoriesWithParent
	
	
	public function getAllSubCategoriesFromParent($cat_id) {
		
		$query =
			"SELECT * " .
			"FROM `" . TBL_SUBCATEGORY . "`" .
			"WHERE `fk_cat_id` = :cat_id";
		
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->bindValue(":cat_id", $cat_id, PDO::PARAM_INT);
		$stmt->execute();
		$subCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $subCategories;
		
		
	} // # END getAllSubCategoriesFromParent
	
	
	/**
	 * Löscht eine Unter-Kategorie aus der Datenbank.
	 * 
	 * @param $sub_id	Die ID der Unter-Kategorie, die gelöscht werden
	 * 					soll
	 *
	 * @return bool		Wahrheitswert, ob der Datensatz gelöscht
	 * 					wurde
	 */
	public function deleteSubCategory($sub_id) {
		
		$query = "DELETE FROM `" . TBL_SUBCATEGORY . "` " .
					"WHERE `sub_id` = :sub_id";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->bindValue(":sub_id", $sub_id, PDO::PARAM_INT);
		$deleted = $stmt->execute();
		
		return $deleted;
		
		
	} // # END deleteSubCategory
	
}

?>