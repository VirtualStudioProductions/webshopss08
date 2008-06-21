		<!-- das Hauptfenster der Seite. Hier werden alle zur Bestellung ausgewählten Artikel angezeigt -->
			<div class="itemtitle">
				<h2>Ihr Warenkorb</h2>
			</div>
			
			<div class="basketline">
			
				<table border="1">
					<tr>
							<td>
								Menge
							</td>
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
								{$article.ar_count}
								<a title="Menge um eine Einheit erh&ouml;hen" href="index.php?site=basket&arNumber={$article.ar_number}&action=2" class="shoppingcart">
									<img src="presentation/images/inc.jpg" height=20% width=20% alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
								
								<a title="Menge um eine Einheit verringern" href="index.php?site=basket&arNumber={$article.ar_number}&action=3" class="shoppingcart">
									<img src="presentation/images/dec.jpg" height=20% width=20% alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
								
							</td>
							
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
								<a title="Aus dem Warenkorb entfernen" href="index.php?site=basket&arNumber={$article.ar_number}&action=0" class="shoppingcart">
									<img src="presentation/images/loeschen.jpg" height=30% width=30% alt="In den Warenkorb legen" />
								</a>
							</td>
					
						</tr>
					
					{/foreach}
				
				</table>
			
			</div>