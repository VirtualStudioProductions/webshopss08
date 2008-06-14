<?php

// Smarty Template Engine einbinden
require_once("api/smarty/Smarty.class.php");


abstract class SITE {
	
	
	/** Der UseCase, den diese Seite erf�llt */
	protected $useCase;
	
	/** Das Template, das dieser Seite zugewiesen ist */
	protected $template;
	
	/**
	 * Die Template-Engine, die verwendet werden soll,
	 * um das Template zu verarbeiten.
	 */
	protected $TEMPLATE_ENGINE;
	
	
	public function SITE($useCase) {
		
		$this->useCase			= $useCase;
		
		// Neues Smarty Objekt als Template-Engine erzeugen
		$this->TEMPLATE_ENGINE	= new Smarty();
	
	} // # END SITE
	
	
	/**
	 * Methode zum Zuweisen von Variablen an das Template.
	 */
	protected function fillTemplate() {
		
		// $categories enth�lt dann alle DB Eintr�ge der Artikel
		$categories = $this->useCase->listAllCategories();

		// Das $categories Array ist nun unter dem Namen "categories" im Template verf�gbar
		$this->TEMPLATE_ENGINE->assign("categories", $categories);
		
		//gew�hlte Kategorie id einlesen und ans Template weiterreichen:
		$c_id = $_GET["cat"];
		$this->TEMPLATE_ENGINE->assign("c_id", $c_id); //im Template auch verf�gbar als c_id
		
		$subcategories = $this->useCase->listAllSubCategories($c_id);
		$this->TEMPLATE_ENGINE->assign("subcategories", $subcategories);
		
		// Seitentitel zuweisen
		$this->TEMPLATE_ENGINE->assign("PAGE_TITLE", PAGE_TITLE);
		
		// Flag zuweisen, ob Cookies verf�gbar sind
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