		<h2>Herzlich Willkommen auf dem SSW Pointerhell Webshop, bitte beachten Sie unsere neuen Artikel:</h2>

	{foreach from=$new_articles item=currentNewArticle} {*Alle neuen Artikel anzeigen*}		
		<div class="newarticle">
			<h3>{$currentNewArticle.title|truncate:90}</h3>
			
			<div class="newarticleimagebox">
				<a href="index.php?site=article&amp;cat={$currentNewArticle.cat_id}&amp;sub={$currentNewArticle.sub_id}&amp;arNumber={$currentNewArticle.number}&amp;handheld={$smarty.get.handheld}" title="{$currentArticle.title}">
				<img src="presentation/images/article/{$currentNewArticle.picture}" alt="{$currentNewArticle.title}" width="200" height="150" />
				</a>
			</div>
			

			
			<div class="addtobasket">	
				<a title="In den Warenkorb einf&uuml;gen" href="index.php?site=basket&amp;arNumber={$currentNewArticle.number}&amp;action=1&amp;handheld={$smarty.get.handheld}">
					<img src="presentation/images/shoppingcart.jpg" alt="In den Warenkorb legen" />
				</a>
			</div>
			
			<div class="newarticleprice">
				{$currentNewArticle.price}&euro;
			</div>
			
		</div>
	{/foreach}