<?php

// Config Datei einbinden
require_once("config.inc.php");

// Smarty Template Engine einbinden
require_once("api/smarty/Smarty.class.php");

// Seiten einbinden
require_once("presentation/sites/SITERegistration.class.php");
require_once("presentation/sites/SITELogin.class.php");
require_once("presentation/sites/SITEImpressum.class.php");
require_once("presentation/sites/SITEStartpage.class.php");
require_once("presentation/sites/SITEArticle.class.php");

// Cookies testen, nur falls noch nicht getestet für diese
// Seite und keine POST-Daten gesendet wurden.
if ($_GET["tested"] != true && !$_POST) {
	setcookie("webshoptest", "active", time() + 60);
	header("Location: " . $_SERVER["PHP_SELF"] . "?site=" . $_GET["site"] . "&tested=true");
}

// Session-Sitzung starten
session_start();

// versuche Datenbankverbindung herzustellen
try{
	$DATA_ACCESS = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, // Treiberangaben
        DB_USER, // Username
        DB_PASS, // Passwort
        array(
        	PDO::ATTR_PERSISTENT => DB_PERSISTENT // Persistente Verbindung
    	));

	} catch(PDOException $e) {
    	echo $e->getMessage(); //evtl noch anders behandeln falls die db connection fehlschlägt
		}
    	
    	

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
		$SITE = new SITEStartpage($SMARTY);
		break;
		
}

// Am Objekt SITE die Funktion display aufrufen, um die Seite anzuzeigen
$SITE->display();

?>