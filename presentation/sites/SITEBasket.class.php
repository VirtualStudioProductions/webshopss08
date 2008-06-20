<?php

require_once("logic/UCBasket.class.php");
require_once("SITE.class.php");


class SITEBasket extends SITE {
	
	
	public function SITEBasket() {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE(new UCBasket());
		
		$this->template = TPL_Basket;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
		if($_SESSION["basketindex"] == null) {
			$_SESSION["basketindex"] = 0;
		}
		
		if(($_GET["arNumber"] != null) && ($_GET["delete"] == 0)) {
			$present = 0;
			foreach($_SESSION["basket"] as $article) {
				if($article == $_GET["arNumber"]) {
					$present = 1;
					$i++;
				}
			}
			
			if($present == 0) {
				$_SESSION["basket"][$_SESSION["basketindex"]] = $_GET["arNumber"];
				$_SESSION["basketindex"]++;
			}
		}
		
		if(($_GET["arNumber"] != null) && ($_GET["delete"] == 1)) {
			
			$i = 0;
			foreach($_SESSION["basket"] as $article) {
				if(($article != null) && ($article != $_GET["arNumber"])) {
					$cleanedbasket[$i] = $article;
					$i++;
				}
			}
			$_SESSION["basket"] = $cleanedbasket;
		}
		
	} // # END SITEItemOverview
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// Immer mit this auf Attribute zugreifen !!
		
		$selectedArticle = $this->useCase->getSelectedArticle();
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("selectedArticle", $selectedArticle);
		
	} // # END fillTemplate

}

?>