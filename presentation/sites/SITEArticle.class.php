<?php

require_once("logic/UCArticle.class.php");
require_once("SITE.class.php");


class SITEArticle extends SITE {
	
	private $arNumber;
	
	public function SITEArticle($arNumber) {
		
		// Umleitung auf Startseite, falls keine Artikelnummer �bergeben wurde
		// oder keine Subkategorie-Nummer �bergeben wurde
		if ($arNumber == "" || $_GET["sub"] == "") {
			header("Location: " . $_SERVER["PHP_SELF"] . "?site=index.php&handheld=" . $_GET["handheld"]);
		}
		
		// Falls keine Kategorie-Nummer �bergeben wurde, aber Subkategorie-Nummer
		// -> Kategorie Nummer durch Subkategorie-Nummer ermitteln
		// M�sste wahrscheinlich nach SITE, mir jetzt aber wayne
		
		$uc = new UCArticle();
		if ($_GET["cat"] == "" && $_GET["sub"] != "") {
			$arr = $uc->getCatFromSub($_GET["sub"]);
			$_GET["cat"] = $arr["fk_cat_id"];
		}
		
		// �quivalent zum "super" Aufruf in Java*
		parent::SITE($uc);
		
		$this->template = TPL_Article;
				
		//Artikelnummer als Attribut f�r fillTemplate hinterlegen
		$this->arNumber = $arNumber;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEArticle
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// Immer mit this auf Attribute zugreifen !!

		$article = $this->useCase->getArticle($this->arNumber);
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("article", $article);
		
	} // # END fillTemplate

}

?>