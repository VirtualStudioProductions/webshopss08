<?php

// Config Datei einbinden
require_once("config.inc.php");

// Cookies testen, nur falls noch nicht getestet für diese
// Seite und keine POST-Daten gesendet wurden.

if ($_GET["wsctest"] != 1 && !$_POST
		&& !($_GET["site"] == "adminbasedata" && $_GET["delete"] == 1)) {
			
	setcookie("webshoptest", "active", time() + 60);
	if ($_SERVER["argv"][0] != "") {
		$and = "&";
	}
	header("Location: "
				. $_SERVER["PHP_SELF"]
				. "?wsctest=1"
				. $and
				. $_SERVER["argv"][0]);
				
}


// Versuche Datenbankverbindung herzustellen
try {
	$DATA_ACCESS = new PDO(
		"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, // Treiberangaben
        DB_USER, // Username
        DB_PASS, // Passwort
        array(
        	PDO::ATTR_PERSISTENT => DB_PERSISTENT // Persistente Verbindung
    	));
} 
catch(PDOException $e) {
	 // Eventuell noch anders behandeln falls
	 // die db connection fehlschlägt
   	echo $e->getMessage();
}


// Session-Sitzung starten
session_start();


// Zentrale Kontrollstruktur einbinden, welche die
// aktuelle Seite aufruft
require_once("site_controller.inc.php");


// Die cached Templates wieder löschen, damit diese
// nicht im Eclipse-Projekt auftauchen.
// Nur falls dies als Debugging-Einstellung gesetzt
// ist.
if (EMPTY_CACHED_TEMPLATES == true) {
	require_once("empty_cached_templates.inc.php");
}

?>