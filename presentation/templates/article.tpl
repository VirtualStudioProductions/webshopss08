		<!-- das Hauptfenster der Seite. Hier wird die Artikelliste angezeigt bzw die detaillierten Informationen zu einem Artikel -->
			<div class="itemtitle">
				<h2>{$article.ar_title}</h2>
			</div>
			
			<div class="itembuyarea">
				<div class="itemstatus">
					<div class="itemprice">
						{$article.ar_price} &euro;			
					</div>
					<div class="itemstock">
						{$article.ar_stock} St&uuml;ck auf Lager
					</div>
				</div>
				<a title="In den Warenkorb einf&uuml;gen" href="index.php?site=basket&arNumber={$article.ar_number}&delete=0" class="shoppingcart">
					<img src="presentation/images/shoppingcart.jpg" alt="In den Warenkorb legen" />
				</a>
			</div>
			
			<div class="clear">
			</div>
			
			<div class="imagebox">
				<img class="image" src="presentation/images/article_{$article.ar_number}.jpg" alt="{$article.ar_title}" width="200" height="150" />
			</div>
			
			<div class="itemdescription">
			{$article.ar_description}			 	
			</div> <!-- Ende itemdescription-->