<?php

// ------------------------------------------------------------
// Generelle Einstellungen
// ------------------------------------------------------------

define("SEND_EMAILS",		false);
define("PAGE_TITLE",		"Webshop SS 08");
define("EMAIL",				"webshopss08@starspring.de");
define("TRACE_TIMEOUT",		60 * 60 * 24 * 30);

// ------------------------------------------------------------


// ------------------------------------------------------------
// Template Bezeichnungen Konstanten
// ------------------------------------------------------------

define("TPL_ENDING",		".tpl");
define("TPL_Registration",	"registration"	. TPL_ENDING);
define("TPL_Login",			"login" 		. TPL_ENDING);
define("TPL_Impressum",		"impressum" 	. TPL_ENDING);
define("TPL_Contact",		"contact"	 	. TPL_ENDING);
define("TPL_Startpage",		"startpage" 	. TPL_ENDING);
define("TPL_Article",		"article" 		. TPL_ENDING);

// ------------------------------------------------------------


// ------------------------------------------------------------
// Datenbank Tabellen Bezeichnungen Konstanten
// ------------------------------------------------------------

define("DB_HOST",			"db.hosting-agency.de");
define("DB_NAME",			"db0022802");
define("DB_USER",			"dbuser11585");
define("DB_PASS",			"hansweint");
define("DB_PERSISTENT",		false);

define("DB_PREFIX",			"ws_");
define("TBL_CUSTOMER",		DB_PREFIX . "customer");
define("TBL_TRACE",			DB_PREFIX . "trace");
define("TBL_ARTICLE",		DB_PREFIX . "article");
define("TBL_CATEGORY",		DB_PREFIX . "category");
define("TBL_SUBCATEGORY",	DB_PREFIX . "subcategory");

// ------------------------------------------------------------

?>