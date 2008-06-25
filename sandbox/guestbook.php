<?php
//
$DATA_ACCESS = new PDO(
        "mysql:host=localhost;dbname=guestbook", // Treiberangaben
        "root", // Username
        "", // Passwort
        array(
        PDO::ATTR_PERSISTENT => true // Persistente Verbindung
     ));

if ($_POST["name"]!="")     
     
if ($_POST["s_guestbook"]){

	$sql="INSERT INTO `guestbook` (`name`, `nachricht`)
	      VALUES(:name, :nachricht)";
	
	$stmt=$DATA_ACCESS->prepare($sql); //SQL Statement vorbereiten, gibt sql statement objekt zur�ck
	$stmt->bindValue(":name", $_POST["name"]); //Wertzuweisung f�r den Namen
	$stmt->bindValue(":nachricht", $_POST["nachricht"]);
	$stmt->execute(); //Ausf�hren des SQL Befehls
}

$sql="SELECT * FROM `guestbook`";
$stmt=$DATA_ACCESS->prepare($sql);
$stmt->execute();   //SQL Befehl ausf�hren
//$guestbook_array=$stmt->fetchAll();  //die von der SQL Anfrage zur�ckgegebenen Werte in ein Array eintragen

//print_r($guestbook_array); //testweise alles ausgeben

?>



<!-- neues Formular erstellen: alle Felder men�s etc. kommen innerhalb der form tags rein -->
<form action="guestbook.php" method="post">

	Name:<br />
	<input type="text" name="name" />
	<br /><br />
	Nachricht:<br />
	<textarea name="nachricht"></textarea>
	<br /><br />
	<input type="submit" name="s_guestbook" /> <!-- submit knopf -->
	<input type="reset" name="reset" /> <!-- reset knopf name ist hier optional -->
	
</form>

<?php 
//alle namen der g�stebucheintr�ge ausgeben
while ( $guestbook_array=$stmt->fetch() ){
	print $guestbook_array["name"] . "<br />";
}

?>