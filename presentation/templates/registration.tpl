<div id="content">
		
		
	<h1>Registrieren</h1>
	
	{if $msg.valid}
	
		<p>Vielen Dank f&uuml;r Ihre Registrierung! Sie sollten in K&uuml;rze eine
		E-Mail erhalten, mit der Sie Ihren neuen Account aktivieren k&ouml;nnen!
		Wir w&uuml;nschen Ihnen einen angenehmen Einkauf in unserem Webshop!</p>
		
		<p>Klicken Sie <a href="index.php" title="Zur&uuml;ck zur Startseite">hier</a>,
		um zur&uuml;ck zur Startseite zu gelangen!</p>
		
	{else if}
	
		<p>Damit Sie im Webshop Bestellungen abschicken k&ouml;nnen, m&uuml;ssen Sie ein
		registrierter Kunde bei uns sein. Nutzen Sie dieses Formular um jetzt
		Kunde zu werden.</p>
		
		{$F_REGISTRATION->display($msg)}
		
	{/if}
		
			
</div>	<!-- Ende content-->
