<h2>Herzlich Willkommen auf dem SSW Pointerhell Webshop</h2>

<h3>Bitte beachten Sie unsere neuen Artikel:</h3>

	{foreach from=$new_articles item=currentNewArticle} {*Alle neuen Artikel anzeigen*}		
		<div class="newarticle">
			<h3>{$currentNewArticle.title|truncate:65}</h3>
			
			<div class="newarticleimagebox">
				<a title="Zeige Details zu: {$currentNewArticle.title}" href="index.php?site=article&amp;cat={$currentNewArticle.cat_id}&amp;sub={$currentNewArticle.sub_id}&amp;arNumber={$currentNewArticle.number}&amp;handheld={$smarty.get.handheld}">
					<img src="presentation/images/article/{$currentNewArticle.picture}" alt="{$currentNewArticle.title}" width="200" height="150" />
				</a>
			</div>
				
			<a title="In den Warenkorb einf&uuml;gen" href="index.php?site=basket&amp;arNumber={$currentNewArticle.number}&amp;action=1&amp;handheld={$smarty.get.handheld}">
				<img class="addtobasket" src="presentation/images/shoppingcart_small.jpg" alt="In den Warenkorb legen" />
			</a>

			
			<div class="newarticleprice">
				{$currentNewArticle.price} &euro;
			</div>
			
		</div>
	{/foreach}
	<div class="clear"></div>