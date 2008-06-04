<?php

/**
 * Zuständig für sämtliche Operationen, die auf die
 * Kunde - Tabelle des Webshops angewandt werden.
 */ 


class DAOCustomer {
	
	
	
	public function getLastID() {
		
		global $DATA_ACCESS;
		
		$query = "SELECT `cu_id` FROM `" . TBL_CUSTOMER . "` ORDER BY `cu_id` DESC LIMIT 0, 1";
		$stmt = $DATA_ACCESS->prepare($query);
		$stmt->execute();
	
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		return $result["cu_id"];
	
	} // # END getLastID
	
}

?>