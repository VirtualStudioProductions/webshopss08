		<!-- das Hauptfenster der Seite. Hier wird die Artikelliste angezeigt bzw die detaillierten Informationen zu einem Artikel -->
			<div class="itemtitle">
				<h2>{$article.ar_title}</h2>
			</div>
			
			<div class="itemprice">
				{$article.ar_price} &euro;			
			</div>
			<div class="buybutton">
				<img src="presentation/images/"
			
			<div class="imagebox">
				<img class="image" src="presentation/images/article_{$article.ar_number}.jpg" alt="{$article.ar_title}" width="200" height="150"></img>
			</div>
			
			<div class="itemdescription">
			{$article.ar_description}			 	
			</div> <!-- Ende itemdescription-->