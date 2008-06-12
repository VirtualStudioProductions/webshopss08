<?php

// Config Datei einbinden
require_once("config.inc.php");

// Smarty Template Engine einbinden
require_once("api/smarty/Smarty.class.php");


// Cookies testen, nur falls noch nicht getestet für diese
// Seite und keine POST-Daten gesendet wurden.
if ($_GET["wsctest"] != 1 && !$_POST) {
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


// Session-Sitzung starten
session_start();


// versuche Datenbankverbindung herzustellen
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
   	echo $e->getMessage(); // eventuell noch anders behandeln falls die db connection fehlschlägt
}


// Neues Smarty Objekt als Template-Engine erzeugen
$TEMPLATE_ENGINE = new Smarty();	


// Zentrale Kontrollstruktur einbinden
require_once("sitecontroller.inc.php");


// Am Objekt SITE die Funktion display aufrufen, um die Seite anzuzeigen
$SITE->display();

?>