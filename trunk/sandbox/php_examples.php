


<?php
/*super globale variablen*/

/*inder URL können attribute mitgegeben werden:*/
/* http://localhost/index.php?x=10&y=11;    */
	$_GET["x"];
	$_GET["y"];
	print $_GET["x"];
	print $_GET["y"];
	
	/*zeuch was der benutzer in felder eingibt kann eingelesen werden*/
	$_POST["Name"];
	$_SERVER["PHP_SELF"];
?>


<?php
	//include ("filez.html"); /*datei filez.html einbinden*/
	//include_once ("...");/*nur einmaliges einbinden der datei erlaubt*/
	//require ("..."); /*diese datei wird eingebunden und MUSS existieren, sonst fatal error*/
?>

<?php
	class TestKlasse{
		private $var1;
		
		/*Konstruktor heisst so wie die klasse allerdings immer mit dem "function" davor*/
		public function TestKlasse(){
			$this -> var1 = 10; /*verwendung von this*/
			
		}
		
		function drucke($x){
			print $x;
		}
	}
	
	$A = new TestKlasse(); /* neues testklassenobjekt erzeugen*/
	$A->drucke("<br>testausdruck<br>"); /*aufruf der funktion drucke am objekt A*/
	
?>

<?php
	//Kommentare
	/* gehen so */
	print "Hello World :-) testvt test blah";

	$variablenname = 10;
	print $variablenname;
	array ($name);
	$name[0] = "a10b";
	$name[1] = 13;
	$name[2] = $name[0] + $name[1];
	$name["Wohnort"] = "Ingolstadt"; /*array indizes könne uahc strings sein :-)*/
	print "array ausgeben <br>";
	print_r ($name);
	
	for ($i=0; $i<10; $i++){
		if ($i%2 == 0)
			print "<strong>$i ist gerade; <br></strong>";
		else
			print "<strong>$i ist ungerade; <br></strong>";
	}
	
?>


<?php
	for ($i=0; $i<3; $i++){
/*der html code wird also 3-mal ausgeführt!*/
?>

<p>test</p>
<?php
}

?>


<?php
/*Verwendung von Funktionen*/
	function blah ($x, $y){
		return $x+$y;
	}
	
	$inhalt = blah(10,20);
	
	print $inhalt;
?>


