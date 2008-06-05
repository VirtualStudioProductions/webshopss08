<?php

// Config Datei einbinden
require_once("config.inc.php");

// Smarty Template Engine einbinden
require_once("api/smarty/Smarty.class.php");

// Seiten einbinden
require_once("presentation/sites/SITEItemOverview.class.php");
require_once("presentation/sites/SITERegistration.class.php");
require_once("presentation/sites/SITELogin.class.php");
require_once("presentation/sites/SITEImpressum.class.php");
require_once("presentation/sites/SITEArticle.class.php");

// Session-Sitzung starten
session_start();

// Datenbankverbindung herstellen
$DATA_ACCESS = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, // Treiberangaben
        DB_USER, // Username
        DB_PASS, // Passwort
        array(
        	PDO::ATTR_PERSISTENT => DB_PERSISTENT // Persistente Verbindung
    	));
    	

// Neues Smarty Objekt erzeugen
$SMARTY = new Smarty();	



// Objekt der aktuellen Seite erzeugen, Template-Engine mitgeben
switch ($_GET["site"]) {
	
	case "registration":
		if ($_SESSION["USER"] == null) {
			$SITE = new SITERegistration($SMARTY);
		}
		else {
			$SITE = new SITELogin($SMARTY);
		}
		break;
		
	case "login":
		$SITE = new SITELogin($SMARTY);
		break;
		
	case "impressum":
		$SITE = new SITEImpressum($SMARTY);
		break;
	
	case "article":
		$SITE = new SITEArticle($SMARTY, $_GET["arNumber"]);
		break;
	
	default:
		$SITE = new SITEItemOverview($SMARTY);
		break;
		
}
// Am Objekt SITE die Funktion display aufrufen, um die Seite anzuzeigen
$SITE->display();

?>