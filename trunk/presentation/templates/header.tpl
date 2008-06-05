<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!-- tags ohne ende tag können so vereinfacht geschlossen werden -->
<link rel="stylesheet" href="presentation/css/default.css" type="text/css" />
<link rel="stylesheet" href="presentation/css/mobile.css" type="text/css" media="handheld" />
{if $smarty.get.site == "registration"}<link rel="stylesheet" href="presentation/css/registration.css" type="text/css" />
{/if}
<title>{$PAGE_TITLE}</title>
</head>

<body>

<div id="sitebox">

	<div id="banner">
		<div id="bannerleft"><h1 class="hidden">{$PAGE_TITLE}</h1></div>
	</div>
	
	<div id="mainmenu">
		<a href="#">Login</a> ::
		<a title="Registrieren Sie sich und werden Sie Kunde!" href="index.php?site=registration">Registrieren</a> ::
		<a href="#">Warenkorb</a>		
	</div>

