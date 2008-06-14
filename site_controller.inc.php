<?php

// Objekt der aktuellen Seite erzeugen, aufgrund von
// GET-Parameter

switch ($_GET["site"]) {
	
	
	case "registration":
		
		// Nur falls kein User eingeloggt ist, sonst Umleitung auf Login
		if ($_SESSION["USER"] == null) {
			require_once("presentation/sites/SITERegistration.class.php");
			$SITE = new SITERegistration();
		}
		else {
			header("Location: " . $_SERVER["PHP_SELF"] . "?site=login");
			$SITE = new SITELogin();
		}
		
		break;
		
		
	case "login":
		
		require_once("presentation/sites/SITELogin.class.php");
		$SITE = new SITELogin();
		
		break;
		
		
	case "impressum":
		
		require_once("presentation/sites/SITEImpressum.class.php");
		$SITE = new SITEImpressum();
		
		break;
		
		
	case "contact":
		
		require_once("presentation/sites/SITEContact.class.php");
		$SITE = new SITEContact();
		
		break;
		
		
	case "admin":
		
		// nur falls wirklich ein Admin eingeloggt ist
		require_once("admin_check.inc.php");
		
		require_once("presentation/sites/admin/SITEAdmin.class.php");
		$SITE = new SITEAdmin();
		
		break;
		
		
	case "adminbasedata":
		
		// nur falls wirklich ein Admin eingeloggt ist
		require_once("admin_check.inc.php");
		
		require_once("presentation/sites/admin/SITEAdminBaseData.class.php");
		$SITE = new SITEAdminBaseData();
		
		break;
	
		
	case "article":
		
		require_once("presentation/sites/SITEArticle.class.php");
		$SITE = new SITEArticle($_GET["arNumber"]);
		
		break;
		
		
	case "category":
		
		require_once("presentation/sites/SITECategory.class.php");
		$SITE = new SITECategory();
		
		break;
	
		
	default:
		
		require_once("presentation/sites/SITEStartpage.class.php");
		$SITE = new SITEStartpage();
		
		break;
		
}

// Am Objekt SITE die Funktion display aufrufen,
// um die Seite anzuzeigen
$SITE->display();

?>