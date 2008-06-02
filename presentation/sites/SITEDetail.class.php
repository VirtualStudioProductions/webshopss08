<?php
class SITEDetail{
	private $template;
	
	public function SITEDetail(){
		$this->template = "detailansicht.tpl";
	}
	
	public function display($TEMPLATE_ENGINE){
		
		$TEMPLATE_ENGINE->assign("SITE", $this->template); //weist template die Variable SITE zu
		$TEMPLATE_ENGINE->display("index.tpl");
	}
}
?>