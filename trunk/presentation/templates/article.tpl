		<!-- das Hauptfenster der Seite. Hier wird die Artikelliste angezeigt bzw die detaillierten Informationen zu einem Artikel -->
			
						
			<h2>Artikel - Details</h2>
			
			
			<h3>{$article.ar_title}</h3>


			<div id="articlebuyarea">
			
				<div id="articlestatus">
				
					<div id="articleprice">
						{$article.ar_price} &euro;			
					</div>
					
					<div id="articlestock">
						{$article.ar_stock} St&uuml;ck auf Lager
					</div>
					
				</div>
				
				<a title="In den Warenkorb einf&uuml;gen" href="index.php?site=basket&amp;arNumber={$article.ar_number}&amp;action=1&amp;handheld={$smarty.get.handheld}">
					<img id="articleimage" src="presentation/images/shoppingcart.jpg" alt="In den Warenkorb legen" />
				</a>
				
			</div>
			
			<div class="clear"></div>
			
			<div id="articleimagebox">
				<img src="presentation/images/article/{$article.ar_picture}" alt="{$article.ar_title}" width="200" height="150" />
			</div>
			
			<div class="articledescription">
				{$article.ar_description}			 	
			</div>