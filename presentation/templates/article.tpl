		<!-- das Hauptfenster der Seite. Hier wird die Artikelliste angezeigt bzw die detaillierten Informationen zu einem Artikel -->
			<div class="itemtitle">
				<b>{$article.ar_title}</b>
			</div>
						
			<div class="imagebox">
				<img class="image" src="presentation/images/article_{$article.ar_number}.jpg" alt="{$article.ar_title}" width="200" height="150"></img>
			</div>
			
			<div class="itemdescription">
			{$article.ar_description}			 	
			</div> <!-- Ende itemdescription-->