<?php

// Kleines Script, welches �berpr�ft, ob ein Administrator
// eingeloggt ist. Falls nicht -> Weiterleitung

if ($_SESSION["USER"]["cu_admin"] != 1) {
	header("Location: " . $_SERVER["PHP_SELF"] . "?handheld=" . $_GET["handheld"]);
}

?>