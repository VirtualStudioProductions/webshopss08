		<!-- das Hauptfenster der Seite. Hier werden alle zur Bestellung ausgewählten Artikel angezeigt -->
			<div class="itemtitle">
				<h2>Ihr Warenkorb</h2>
			</div>
			
			<div class="basketline">
			
				<table>
					<tr>
							<th>
								Menge
							</th>
							<th>
								Artikelnummer
							</th>
	
							<th>
								Bezeichnung	
							</th>
						
							<th>
								Lagerbestand
							</th>
					
							<th>
								Preis
							</th>

							<th>
								Bearbeiten
							</th>
					
						</tr>
					{foreach from=$selectedArticle item=article}
				
						<tr>
							<td>
								{$article.ar_count}
								
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
								<a title="Menge um eine Einheit erh&ouml;hen" href="index.php?site=basket&arNumber={$article.ar_number}&action=2" class="shoppingcart">
									<img src="presentation/images/inc.jpg" height="20px" width="20px" alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
								
								<a title="Menge um eine Einheit verringern" href="index.php?site=basket&arNumber={$article.ar_number}&action=3" class="shoppingcart">
									<img src="presentation/images/dec.jpg" height="20px" width="20px" alt="Menge um eine Einheit erh&ouml;hen" />
								</a>
								<a title="Aus dem Warenkorb entfernen" href="index.php?site=basket&arNumber={$article.ar_number}&action=0" class="shoppingcart">
									<img src="presentation/images/loeschen.jpg" height="20px" width="20px" alt="In den Warenkorb legen" />
								</a>
							</td>
					
						</tr>
					
					{/foreach}
				
				</table>
			
			</div>