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
				if($article["arNumber"] == $_GET["arNumber"]) {
					$present = 1;
				}
			}
			
			if($present == 0) {
				$_SESSION["basket"][$_SESSION["basketindex"]]["arNumber"] = $_GET["arNumber"];
				$_SESSION["basket"][$_SESSION["basketindex"]]["count"] = 1;
				$_SESSION["basketindex"]++;
			}
			else {
				for($j = 0; $j < $_SESSION["basketindex"];$j++) {
					if($_SESSION["basket"][$j]["arNumber"] == $_GET["arNumber"]) {
						$_SESSION["basket"][$j]["count"]++;
					}
				}
			}			
		}
		
		
		if(($_GET["arNumber"] != null) && ($_GET["delete"] == 1)) {
			
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
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("selectedArticle", $selectedArticle);

		
	} // # END fillTemplate

}

?>