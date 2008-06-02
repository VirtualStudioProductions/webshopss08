<?php
// Testklasse
require_once("../dao/DAOArticle.class.php");

	$dao = new DAOArticle();
	$dao->getArticle(2);
	
?>