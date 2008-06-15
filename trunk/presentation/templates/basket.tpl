		<!-- das Hauptfenster der Seite. Hier werden alle zur Bestellung ausgewählten Artikel angezeigt -->
			<div class="itemtitle">
				<h2>Ihr Warenkorb</h2>
			</div>
			
			<div class="basketline">
			
				<table border="1">
					<tr>
							<td>
								Artikelnummer
							</td>
	
							<td>
								Bezeichnung	
							</td>
						
							<td>
								Lagerbestand
							</td>
					
							<td>
								Preis
							</td>

							<td>
							</td>
					
						</tr>
					{foreach from=$selectedArticle item=article}
				
						<tr>
							<td>
								{$article.ar_number}
							</td>
	
							<td>
								{$article.ar_title}	
							</td>
						
							<td>
								{$article.ar_stock}
							</td>
					
							<td>
								{$article.ar_price}
							</td>

							<td>
							Loeschen
							</td>
					
						</tr>
					
					{/foreach}
				
				</table>
			
			</div>