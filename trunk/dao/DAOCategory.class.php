<?php
/**
 * Zuständig für sämtliche Operationen, die auf die Kategorie-Tabelle
 * des Webshops angewandt werden.
 */


require_once("DAO.class.php");


class DAOCategory extends DAO {
	

	public function getAllCategories(){
		
		$sql="SELECT `cat_name` AS `name`, `cat_id` AS `id`" .
		  "FROM " . TBL_CATEGORY . " ORDER BY `cat_name` ASC ";
		
		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->execute();
		//alle Spalteneinträge in Array $arr schreiben
		$arr = $stmt->fetchAll( PDO::FETCH_ASSOC );
		return $arr;
	
	} // # END getAllCategories
	
/**
 * liefert ein Array mit allen Unterkategorienamen einer Kategorie zurück
 *
 * @param String $catname; hier wird der Kategoriename angegeben zu dem die Unterkategorien gesucht werden
 * @return returned ein assoziatives Array z.B. [0] => Array([name] => Unterkategorie)
 */	
	public function getSelectedSubcategories($cat_id){
		
		$sql="SELECT `sub_name` AS `name`, `sub_id` AS `id` 
		FROM " . TBL_CATEGORY . " AS cat JOIN " . 
     	TBL_SUBCATEGORY . " AS sub " . 
		" ON cat.cat_id = sub.fk_cat_id " .  
		" WHERE cat.cat_id = :cat_id " . 
     	" ORDER BY `sub_name` ASC ";
		
		$stmt = $this->DATA_ACCESS->prepare($sql);
		$stmt->bindValue(":cat_id", $cat_id, PDO::PARAM_STR);
		$stmt->execute();
		$arr = $stmt->fetchAll( PDO::FETCH_ASSOC);
		
		//print_r($arr);
		return $arr;
	}
	

	
	/**
	 * Löscht eine Kategorie aus der Datenbank.
	 * 
	 * @param $cat_id	Die ID der Kategorie, die gelöscht werden
	 * 					soll
	 *
	 * @return bool		Wahrheitswert, ob der Datensatz gelöscht
	 * 					wurde
	 */
	public function deleteCategory($cat_id) {
		
		$query = "DELETE FROM `" . TBL_CATEGORY . "` " .
					"WHERE `cat_id` = :cat_id";
		$stmt = $this->DATA_ACCESS->prepare($query);
		$stmt->bindValue(":cat_id", $cat_id, PDO::PARAM_INT);
		$deleted = $stmt->execute();
		
		return $deleted;
		
		
	} // # END deleteCategory
	

}

?>