<?php
require_once("SITE.class.php");
require_once("logic/UC.class.php");
require_once("logic/UCSubCategoryArticles.class.php");

class SITECategory extends SITE {

	public function SITECategory() {
		
		// Umleitung auf Startseite, falls keine Kategorie-Nummer
		// übergeben wurde
		if ($_GET["cat"] == "") {
			header("Location: " . $_SERVER["PHP_SELF"] . "?site=index.php&handheld=" . $_GET["handheld"]);
		}
		
		// Äquivalent zum "super" Aufruf in Java*
		parent::SITE(new UCSubCategoryArticles());
		
		$this->template = TPL_Category;
		
		// Private Funktion fillTemplate aufrufen
		$this->fillTemplate();
		
	} // # END SITECategory
		


	protected function fillTemplate() {
		
		parent::fillTemplate(); //Zuerst die von SITE.class.php geerbte fillTemplate Funktion aufrufen um die Kategorieansicht anzuzeigen
		// Immer mit this auf Attribute zugreifen !!
		
		$sub_id = $_GET["sub"];
		//print("die subcategory id ist:");
		//print_r($s_id);

		//in diesem array stehen alle artikel der aktiven unterkategorie mit ihren attributen
		$subcat_articles = $this->useCase->getSubCategoryArticles($sub_id);
		
		// Formular an das Template zuweisen
		$this->TEMPLATE_ENGINE->assign("subcat_articles", $subcat_articles);
		
	} // # END fillTemplate

}

?>