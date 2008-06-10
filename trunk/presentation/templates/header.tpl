<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!-- tags ohne ende tag können so vereinfacht geschlossen werden -->
<link rel="stylesheet" href="presentation/css/default.css" type="text/css" />
<link rel="stylesheet" href="presentation/css/mobile.css" type="text/css" media="handheld" />
{if $smarty.get.site == "registration"}<link rel="stylesheet" href="presentation/css/registration.css" type="text/css" />{/if}
{if $smarty.get.site == "contact"}<link rel="stylesheet" href="presentation/css/contact.css" type="text/css" />{/if}
{if $smarty.get.site == "login"}<link rel="stylesheet" href="presentation/css/login.css" type="text/css" />{/if}
<title>{$PAGE_TITLE}</title>
</head>

<body>

<div id="sitebox">

	<div id="banner">
		<h1 class="hidden">{$PAGE_TITLE}</h1>
		<a href="{$smarty.server.PHP_SELF}?index.php" title="Zur Startseite" id="bannerleft"></a>
	</div>
	
	<div id="mainmenu">
		{if $smarty.session.USER == null}
			<a title="Loggen Sie sich jetzt ein um erweiterte Funktionalit&auml;t nutzen zu k&ouml;nnen!" href="{$smarty.server.PHP_SELF}?site=login">Login</a>
		{else}
			{$smarty.session.USER.cu_username} eingeloggt ::
			<a title="Logout!" href="{$smarty.server.PHP_SELF}?site=login&logout=1">Logout</a>
		{/if} ::
		{if $smarty.session.USER == null}
			<a title="Registrieren Sie sich und werden Sie Kunde!" href="{$smarty.server.PHP_SELF}?site=registration">Registrieren</a> ::
		{/if}
		<a href="#">Warenkorb</a>
	</div>

