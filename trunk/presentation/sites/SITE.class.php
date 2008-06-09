<?php

abstract class SITE {
	
	
	/** Der UseCase, den diese Seite erfüllt */
	//protected $useCase;
	
	/** Das Template, das dieser Seite zugewiesen ist */
	protected $template;
	
	/**
	 * Die Template-Engine, die verwendet werden soll,
	 * um das Template zu verarbeiten.
	 */
	protected $TEMPLATE_ENGINE;
	
	
	public function SITE($TEMPLATE_ENGINE, $useCase) {

		$this->useCase = $useCase;
		$this->TEMPLATE_ENGINE = $TEMPLATE_ENGINE;
	
	} // # END SITE
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		// $categories enthält dann alle DB Einträge der Artikel
		$categories = $this->useCase->listAllCategories();

		// Das $categories Array ist nun unter dem Namen "categories" im Template verfügbar
		$this->TEMPLATE_ENGINE->assign("categories", $categories);
		
		//Testweise hier ein fester Wert für die ausgewählte Kategorie
		$c_name = "CPUs";
		$this->TEMPLATE_ENGINE->assign("c_name", $c_name); //im Template auhc verfügbar als c_name
		
		$subcategories = $this->useCase->listAllSubCategories($c_name);
		$this->TEMPLATE_ENGINE->assign("subcategories", $subcategories);
		
		// Seitentitel zuweisen
		$this->TEMPLATE_ENGINE->assign("PAGE_TITLE", PAGE_TITLE);
		
		// Flag zuweisen, ob Cookies verfügbar sind
		if ($_COOKIE["webshoptest"] != "") {
			$this->TEMPLATE_ENGINE->assign("cookiesEnabled", true);
		}
		else {
			$this->TEMPLATE_ENGINE->assign("cookiesEnabled", false);
		}
	
	} // # END fillTemplate
	
	
	public function display() {
		
		// Falls $template nicht mit einem Template belegt wurde Exception werfen
		if ($this->template == NULL) {
			throw Exception();
		}
		
		// Weist Template die Variable SITE zu
		$this->TEMPLATE_ENGINE->assign("SITE", $this->template);
		
		// index.tpl anzeigen
		$this->TEMPLATE_ENGINE->display("index.tpl");
	
	} // # END display
}

?>