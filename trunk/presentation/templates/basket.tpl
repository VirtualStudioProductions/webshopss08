		<!-- das Hauptfenster der Seite. Hier werden alle zur Bestellung ausgewählten Artikel angezeigt -->

			<h2>Ihr Warenkorb</h2>

		
			{if $cookiesEnabled}

				{if $selectedArticle != null}
			
					<table>
				
						<tr>
				
							<th width="5%">
								Menge
							</th>
				
							<th width="15%">
								Artikelnummer
							</th>
	
							<th width="50%">
								Bezeichnung	
							</th>
							
							<th width="5%">
								Lager
							</th>
						
							<th width="10%">
								Preis
							</th>

							<th width="15%">
								Bearbeiten
							</th>
						
						</tr>
					
				
						{foreach from=$selectedArticle item=article}
				
						<tr>
				
							<td width="5%" align="center">
								{$article.ar_count|escape}
							</td>
								
							<td width="15%" align="center">
								{$article.ar_number|escape}
							</td>
			
							<td width="50%">
								<a title="{$article.ar_title}" href="index.php?site=article&amp;arNumber={$article.ar_number}&amp;handheld={$smarty.get.handheld}">
									{$article.ar_title|escape}	
								</a>
							</td>
							
							<td width="5%" align="center">
								{$article.ar_stock|escape}
							</td>
					
							<td width="10%" align="center">
								{$article.ar_price|escape} &euro;
							</td>
		
							<td width="15%" align="center">
								<a title="Menge um eine Einheit erh&ouml;hen" href="index.php?site=basket&amp;arNumber={$article.ar_number}&amp;action=2&amp;handheld={$smarty.get.handheld}">
									<img src="presentation/images/inc.jpg" height="20" width="20" alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
										
								<a title="Menge um eine Einheit verringern" href="index.php?site=basket&amp;arNumber={$article.ar_number}&amp;action=3&amp;handheld={$smarty.get.handheld}">
									<img src="presentation/images/dec.jpg" height="20" width="20" alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
						
								<a title="Aus dem Warenkorb entfernen" href="index.php?site=basket&amp;arNumber={$article.ar_number}&amp;action=0&amp;handheld={$smarty.get.handheld}">
									<img src="presentation/images/loeschen.jpg" height="20" width="20" alt="In den Warenkorb legen" />
								</a>
							</td>
						
						</tr>
					
						{/foreach}
				
						<tr>
				
							<th width="5%">
								
							</th>
				
							<th width="15%">
								
							</th>
	
							<th width="50%">
								Summe
							</th>
							
							<th width="5%">
								
							</th>
						
							<th width="10%">
								{$sum} &euro;
							</th>

							<th width="15%">
								
							</th>
						
						</tr>
				
					</table>
			
				{else}
				
					Sie haben keine Artikel im Warenkorb!
					
				{/if}	
			
			{else}
			
					{include file="nocookies.tpl"}
					
			{/if}