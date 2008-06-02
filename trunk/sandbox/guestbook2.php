<?php

require_once("../api/form/Form.class.php");
require_once("../api/form/Field.class.php");


$DATA_ACCESS = new PDO(
        "mysql:host=localhost;dbname=guestbook", // Treiberangaben
        "root", // Username
        "", // Passwort
        array(
        PDO::ATTR_PERSISTENT => true // Persistente Verbindung
     ));
     

$GUESTBOOK_FORM = new Form(
					"guestbook",
					array("name", "nachricht"),
					"guestbook",
					$sql_where,
					"id",
					$custom_type,
					$OWNER_SITE,
					$DATA_ACCESS);

	
$FIELD = new TextField("name", "Name");
$FIELD->set_process_field(true);
$FIELD->set_v_required(true);
$GUESTBOOK_FORM->add_field($FIELD);

$FIELD = new TextArea("nachricht", "Nachricht");
$FIELD->set_process_field(true);
$GUESTBOOK_FORM->add_field($FIELD);


if ($_POST["s_".$GUESTBOOK_FORM->get_form_name().""]) {
	$msg = $GUESTBOOK_FORM->process_form();
}


$GUESTBOOK_FORM->display($msg);


?>