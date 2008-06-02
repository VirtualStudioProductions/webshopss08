<?php

// FIXME: Benötigt Update und Revision!

// -------------------------------------------------------------------
/** 
 * Description: Diese Klasse ist dazu da um Javascript oder andere Actionen einbauen zu können.
 *
 * File: Action.class.php
 * 
 * @author mast0r
 *
 */
// -------------------------------------------------------------------

class Action {
	// CLASS ATTRIBUTES
	
	private $action;
	
	private $a_onfocus = false;
	private $a_onclick = false;
	private $a_onchange = false;
	private $a_onkeydown = false;
	private $a_onkeyup = false;
	private $a_onblur = false;
	private $a_ondblclick = false;
	private $a_onhelp = false;
	private $a_onkeypress = false;
	private $a_onmousedown = false;
	private $a_onmousemove = false;
	private $a_onmouseout = false;
	private $a_onmouseover = false;
	private $a_onmouseup = false;
	private $a_onselect = false;
	
	
	/** Konstruktor
	 * 
	 * @param $action Action, die ausgeführt werden soll.
	 * 
	 */ 
	public function Action($action) {
		// Initialisierung
		$this->action = $action;
	}
	
	// Some getters
	public function get_action()				{ return $this->action; }
	
	public function get_actions(){ 
		$actions = "";
		if($this->a_onblur){ $actions .= "onblur=\"".$this->action."\" "; }
		if($this->a_onchange){ $actions .= "onchange=\"".$this->action."\" "; }
		if($this->a_onclick){ $actions .= "onclick=\"".$this->action."\" "; }
		if($this->a_ondblclick){ $actions .= "ondblclick=\"".$this->action."\" "; }
		if($this->a_onfocus){ $actions .= "onfocus=\"".$this->action."\" "; }
		if($this->a_onhelp){ $actions .= "onhelp=\"".$this->action."\" "; }
		if($this->a_onkeydown){ $actions .= "onkeydown=\"".$this->action."\" "; }
		if($this->a_onkeypress){ $actions .= "onkeypress=\"".$this->action."\" "; }
		if($this->a_onkeyup){ $actions .= "onkeyup=\"".$this->action."\" "; }
		if($this->a_onmousedown){ $actions .= "onmousedown=\"".$this->action."\" "; }
		if($this->a_onmousemove){ $actions .= "onmousemove=\"".$this->action."\" "; }
		if($this->a_onmouseout){ $actions .= "onmouseout=\"".$this->action."\" "; }
		if($this->a_onmouseover){ $actions .= "onmouseover=\"".$this->action."\" ";}
		if($this->a_onmouseup){ $actions .= "onmouseup=\"".$this->action."\" "; }
		if($this->a_onselect){ $actions .= " onselect=\"".$this->action."\" "; }
		
	return $actions; 
	}
	
	// Setters for the action
	public function set_a_onfocus($set)			{ $this->a_onfocus 	 	 = $set; }
	public function set_a_onclick($set)			{ $this->a_onclick		 = $set; }
	public function set_a_onchange($set)		{ $this->a_onchange		 = $set; }
	public function set_a_onkeydown($set)		{ $this->a_onkeydown	 = $set; }
	public function set_a_onkeyup($set)			{ $this->a_onkeyup		 = $set; }
	public function set_a_onblur($set)			{ $this->a_onblur		 = $set; }
	public function set_a_ondblclick($set)		{ $this->a_ondblclick	 = $set; }
	public function set_a_onhelp($set)			{ $this->a_onhelp		 = $set; }
	public function set_a_onkeypress($set)		{ $this->a_onkeypress	 = $set; }
	public function set_a_onmousedown($set)		{ $this->a_onmousedown	 = $set; }
	public function set_a_onmousemove($set)		{ $this->a_onmousemove	 = $set; }
	public function set_a_onmouseout($set)		{ $this->a_onmouseout	 = $set; }
	public function set_a_onmouseover($set)		{ $this->a_onmouseover	 = $set; }
	public function set_a_onmouseup($set)		{ $this->a_onmouseup	 = $set; }
	public function set_a_onselect($set)		{ $this->a_onselect		 = $set; }
	
	
	// Getters for the action
	public function get_a_onfocus()			{ return $this->a_onfocus; }
	public function get_a_onclick()			{ return $this->a_onclick; }
	public function get_a_onchange()		{ return $this->a_onchange; }
	public function get_a_onkeydown()		{ return $this->a_onkeydown; }
	public function get_a_onkeyup()			{ return $this->a_onkeyup; }
	public function get_a_onblur()			{ return $this->a_onblur; }
	public function get_a_ondblclick()		{ return $this->a_ondblclick; }
	public function get_a_onhelp()			{ return $this->a_onhelp; }
	public function get_a_onkeypress()		{ return $this->a_onkeypress; }
	public function get_a_onmousedown()		{ return $this->a_onmousedown; }
	public function get_a_onmousemove()		{ return $this->a_onmousemove; }
	public function get_a_onmouseout()		{ return $this->a_onmouseout; }
	public function get_a_onmouseover()		{ return $this->a_onmouseover; }
	public function get_a_onmouseup()		{ return $this->a_onmouseup; }
	public function get_a_onselect()		{ return $this->a_onselect; }	
	
	
}
?>