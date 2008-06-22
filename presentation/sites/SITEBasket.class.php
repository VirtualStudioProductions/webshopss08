<?php

require_once("logic/UCBasket.class.php");
require_once("SITE.class.php");


class SITEBasket extends SITE {
	
	
	public function SITEBasket() {
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE(new UCBasket());
		
		$this->template = TPL_Basket;
		
		if($_SESSION["basketindex"] == null) {
			$_SESSION["basketindex"] = 0;
		}
		
		//Code um Artikel hinzuzufügen
		$present = 0;
		if(($_GET["arNumber"] != null) && ($_GET["action"] == 1 && $_GET["wsctest"] == 1)) {
			foreach($_SESSION["basket"] as $article) {
				if($article["arNumber"] == $_GET["arNumber"]) {
					$present = 1;
				}
			}
			
			if($present == 0) {
				$_SESSION["basket"][$_SESSION["basketindex"]]["arNumber"] = $_GET["arNumber"];
				$_SESSION["basket"][$_SESSION["basketindex"]]["count"] = 1;
				$_SESSION["basketindex"]++;
			}
					
		}
		
		//Code um Artikelmenge zu erhöhen
		if(($_GET["arNumber"] != null) && ($_GET["action"] == 2 && $_GET["wsctest"] == 1)) {
			for($z1 = 0; $z1 < $_SESSION["basketindex"]; $z1++) {
				if($_SESSION["basket"][$z1]["arNumber"] == $_GET["arNumber"]) {
					$_SESSION["basket"][$z1]["count"]++;
				}
			}			
		}

		
		//Code um Artikelmenge zu verringern
		if(($_GET["arNumber"] != null) && ($_GET["action"] == 3 && $_GET["wsctest"] == 1)) {
			for($z2 = 0; $z2 < $_SESSION["basketindex"];$z2++) {
				if($_SESSION["basket"][$z2]["arNumber"] == $_GET["arNumber"]) {
					if($_SESSION["basket"][$z2]["count"] > 1) {
						$_SESSION["basket"][$z2]["count"]--;
					}
				}
			}			
		}
		
		//Code um Artikel zu entfernen
		if(($_GET["arNumber"] != null) && ($_GET["action"] == 0 && $_GET["wsctest"] == 1)) {
			$i = 0;
			foreach($_SESSION["basket"] as $article) {
				if(($article["arNumber"] != null) && ($article["arNumber"] != $_GET["arNumber"])) {
					$cleanedbasket[$i] = $article;
					$i++;
				}
			}
			$_SESSION["basket"] = $cleanedbasket;
			$_SESSION["basketindex"] = $i;
		}
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITEItemOverview
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// Immer mit this auf Attribute zugreifen !!
		
		$selectedArticle = $this->useCase->getSelectedArticle();

		$k = 0;
	
		while($selectedArticle[$k] != null) {
			foreach($_SESSION["basket"] as $countArticle) {
				if($selectedArticle[$k]["ar_number"] == $countArticle["arNumber"]) {
					$selectedArticle[$k]["ar_count"] = $countArticle["count"];
				}
			}
			$k++;
		}
		
		// Summe berechnen
		$sum = 0;
		if($selectedArticle[0] != null) {
			foreach($selectedArticle as $article) {
					$sum = $sum + ($article["ar_count"]* $article["ar_price"]);
			}	
		}
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("selectedArticle", $selectedArticle);
		$this->TEMPLATE_ENGINE->assign("sum", $sum);

		
	} // # END fillTemplate

}

?>