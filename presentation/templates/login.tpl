	{if $smarty.session.USER == null || !$cookiesEnabled}
	
		<h2>Login</h2>
		
	{else}
	
		<h2>Willkommen, {$smarty.session.USER.cu_username}!</h2>
	
	{/if}
	
	
	
	{if $cookiesEnabled}
	
	
		{if $smarty.session.USER != null}
		
			<p>Sie sind nun eingeloggt!</p>
			<p>Sie k&ouml;nnen sich jederzeit wieder aus dem System ausloggen, indem Sie im oberen
			Men&uuml; auf <em>Logout</em> klicken!</p>
			<p>Viel Spa&szlig; auch weiterhin in unserem Shop!</p>
			
			{if $smarty.session.USER.cu_admin == 1}
			
				<p>Sie sind ein Administrator. Klicken Sie oben im Hauptmen&uuml; auf <em>Admin</em>,
				um den Webshop zu administrieren.</p>
			
			{/if}
		
		{else}
		
			<p>
				Loggen Sie sich ein um Zugang zu erweiterten Funktion zu bekommen. Nur wenn Sie
				als Kunde eingeloggt sind, k&ouml;nnen Sie beispielsweise auch Bestellungen aufgeben!
				Falls Sie noch nicht Kunde sind, k&ouml;nnen Sie sich
				<a href="{$smarty.server.PHP_SELF}?site=registration&amp;handheld={$smarty.get.handheld}" title="Jetzt Kunde werden!">hier</a>
				registrieren!
			</p>
				
			<br />{$F_LOGIN->display($msg)}<br />
		
		{/if}
	
		
	{else}
	
		{include file="nocookies.tpl"}
	
	{/if}
