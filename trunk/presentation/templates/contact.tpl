	<h2>Kontakt</h2>
	
	{if $smarty.get.confirm == 1}
	
		<p>Ihre Kontaktanfrage wurde abgeschickt! Wir werden uns so bald wie m&ouml;glich
		mit Ihnen in Verbindung setzen.</p>
		
		<p>Klicken Sie <a href="{$smarty.server.PHP_SELF}" title="Zur&uuml;ck zur Startseite">hier</a>,
		um zur&uuml;ck zur Startseite zu gelangen!</p>
		
	{else}
	
		<p>Verwenden Sie bitte dieses Formular, falls Sie mit uns in Kontakt
		treten m&ouml;chten.</p>
		
		<br />{$F_CONTACT->display($msg)}<br />
		
	{/if}
