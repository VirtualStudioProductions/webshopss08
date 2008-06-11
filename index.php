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
   	echo $e->getMessage(); //evtl noch anders behandeln falls die db connection fehlschlägt
}
    	
    	
// Neues Smarty Objekt erzeugen
$SMARTY = new Smarty();	


// Objekt der aktuellen Seite erzeugen, Template-Engine mitgeben
switch ($_GET["site"]) {
	
	case "registration":
		if ($_SESSION["USER"] == null) {
			require_once("presentation/sites/SITERegistration.class.php");
			$SITE = new SITERegistration($SMARTY);
		}
		else {
			header("Location: " . $_SERVER["PHP_SELF"] . "?site=login");
			$SITE = new SITELogin($SMARTY);
		}
		break;
		
	case "login":
		require_once("presentation/sites/SITELogin.class.php");
		$SITE = new SITELogin($SMARTY);
		break;
		
	case "impressum":
		require_once("presentation/sites/SITEImpressum.class.php");
		$SITE = new SITEImpressum($SMARTY);
		break;
		
	case "contact":
		require_once("presentation/sites/SITEContact.class.php");
		$SITE = new SITEContact($SMARTY);
		break;
		
	case "admin":
		// Nur falls wirklich ein Admin eingeloggt ist
		if ($_SESSION["user"]["cu_admin"] != 1) {
			// Falls nicht leite den User auf die Startseite um
			header("Location: " . $_SERVER["PHP_SELF"] . "?handheld=" . $_GET["handheld"]);
		}
		else {
			require_once("presentation/sites/SITEAdmin.class.php");
			$SITE = new SITEAdmin($SMARTY);
		}
		break;
	
	case "article":
		require_once("presentation/sites/SITEArticle.class.php");
		$SITE = new SITEArticle($SMARTY, $_GET["arNumber"]);
		break;
		
	case "category":
		require_once("presentation/sites/SITECategory.class.php");
		$SITE = new SITECategory($SMARTY);
		break;
	
	default:
		require_once("presentation/sites/SITEStartpage.class.php");
		$SITE = new SITEStartpage($SMARTY);
		break;
		
}


// Am Objekt SITE die Funktion display aufrufen, um die Seite anzuzeigen
$SITE->display();

?>