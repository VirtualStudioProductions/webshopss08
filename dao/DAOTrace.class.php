<?php

/**
 * Zuständig für sämtliche Operationen, die auf die
 * Trace - Tabelle des Webshops angewandt werden.
 */ 


class DAOTrace {
	
	
	/**
	 * Löscht Traces, die bereits länger in der Datenbank sind, als
	 * im Trace Timeout in der config Datei definiert wurde.
	 */
	public function deleteTimedOutTraces() {
		
		global $DATA_ACCESS;
		
		$query = "DELETE FROM `" . TBL_TRACE . "` WHERE `tr_unixTimeStamp` < :traceTimeout";
		$stmt = $DATA_ACCESS->prepare($query);
		$stmt->bindValue(":traceTimeout", time() - TRACE_TIMEOUT, PDO::PARAM_INT);
		
		$stmt->execute();
		
	} // # END deleteTimedOutTraces
	
	
	/**
	 * Trägt einen neuen Trace-Datensatz in die Datenbank ein.
	 *
	 * @param String $identifier Eindeutiger Identifier des Besuchers.
	 * @param Date $date Das aktuelle Datum.
	 * @param Time $time Die aktuelle Uhrzeit.
	 * @param String $site Die Seite, die der Besucher anschaut.
	 */
	public function insertNewTrace($identifier, $date, $time, $site) {
		
		global $DATA_ACCESS;
		
		if ($site == "") {
			$site = "startpage";
		}
		
		if ($_SESSION["USER"]["cu_username"] != "") {
			$loggedInAs = $_SESSION["USER"]["cu_username"];
		}
		else {
			$loggedInAs = "ANONYMUS";
		}
		
		$query = "INSERT INTO `" . TBL_TRACE . "`
					(`tr_identifier`, `tr_date`, `tr_time`, `tr_site`, `tr_loggedInAs`, `tr_unixTimeStamp`)
					VALUES (:identifier, :date, :time, :site, :loggedInAs, :unixTimeStamp)";
		$stmt = $DATA_ACCESS->prepare($query);
		
		$stmt->bindValue(":identifier", $identifier, PDO::PARAM_STR);
		$stmt->bindValue(":date", $date);
		$stmt->bindValue(":time", $time);
		$stmt->bindValue(":site", $site, PDO::PARAM_STR);
		$stmt->bindValue(":loggedInAs", $loggedInAs, PDO::PARAM_STR);
		$stmt->bindValue(":unixTimeStamp", time(), PDO::PARAM_INT);
		
		$stmt->execute();
	
	} // # END insertNewTrace
	
}

?>