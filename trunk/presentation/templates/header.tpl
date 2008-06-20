<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> {* Tags ohne End-Tag werden so geschlossen!! *}
<link rel="stylesheet" href="presentation/css/default.css" type="text/css" />
{if $smarty.get.handheld == 1}<link rel="stylesheet" href="presentation/css/handheld.css" type="text/css" />{/if}
{if $smarty.get.site == "adminbasedata"}<link rel="stylesheet" href="presentation/css/admin/adminbasedata.css" type="text/css" />{/if}
{if $smarty.get.site == "contact"}<link rel="stylesheet" href="presentation/css/contact.css" type="text/css" />{/if}
{if $smarty.get.site == "login"}<link rel="stylesheet" href="presentation/css/login.css" type="text/css" />{/if}
<title>{$PAGE_TITLE}</title>
</head>

<body>

<div id="sitebox">

	<div id="banner">
		<h1 class="hidden">{$PAGE_TITLE}</h1>
		<a href="{$smarty.server.PHP_SELF}?handheld={$smarty.get.handheld}" title="Zur Startseite" id="bannerleft"></a>
		{if $smarty.get.handheld != 1}
			<a href="{$smarty.server.PHP_SELF}?site={$smarty.get.site}&amp;handheld=1" title="Verwende Handheld-Design" id="designselection">Handheld</a>
		{else}
			<a href="{$smarty.server.PHP_SELF}?site={$smarty.get.site}" title="Verwende normales Design" id="designselection">Normal</a>
		{/if}
	</div>
	
	<div id="mainmenu">
		{if $smarty.session.USER == null}
			<a title="Loggen Sie sich jetzt ein um erweiterte Funktionalit&auml;t nutzen zu k&ouml;nnen!" href="{$smarty.server.PHP_SELF}?site=login&amp;handheld={$smarty.get.handheld}">Login</a>
		{else}
			{$smarty.session.USER.cu_username} ::
			{if $smarty.session.USER.cu_admin == 1}
				<a href="{$smarty.server.PHP_SELF}?site=admin&amp;handheld={$smarty.get.handheld}" title="Zum Administrations-Bereich">Admin</a> ::
			{/if}
			<a title="Logout!" href="{$smarty.server.PHP_SELF}?site=login&amp;handheld={$smarty.get.handheld}&amp;logout=1">Logout</a>
		{/if} ::
		{if $smarty.session.USER == null}
			<a title="Registrieren Sie sich und werden Sie Kunde!" href="{$smarty.server.PHP_SELF}?site=registration&amp;handheld={$smarty.get.handheld}">Registrieren</a> ::
		{/if}
		<a title="Warenkorb" href="{$smarty.server.PHP_SELF}?site=basket&amp;handheld={$smarty.get.handheld}">Warenkorb</a>
	</div>

