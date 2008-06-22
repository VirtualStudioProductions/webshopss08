		W&auml;hlen Sie eine der folgenden Unterkategorien:

		<div id="subcategories">
				
				{foreach from=$subcategories item=currentSubCategory}
					
					<a href="index.php?site=category&amp;cat={$smarty.get.cat}&amp;sub={$currentSubCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentSubCategory.name}">{$currentSubCategory.name}</a> 
					&nbsp;&nbsp;
				{/foreach}
				
		</div>
		
		{if $smarty.get.sub != null}
		
			<div>
	
				<table id="articletable">
				
					<tr>
						<th>Artikelname</th>
						<th>Artikelbeschreibung</th>
						<th>Lagerbestand</th>
						<th>Preis</th>
					</tr>
	
				{foreach from=$subcat_articles item=currentArticle}	
				
					<tr>
						<td><a href="index.php?site=article&amp;arNumber={$currentArticle.number}&amp;handheld={$smarty.get.handheld}" title="{$currentArticle.title}">{$currentArticle.title}</a></td>
						<td>{$currentArticle.description|truncate}</td>
						<td align="center">{$currentArticle.stock}</td>
						<td align="center">{$currentArticle.price} &euro;</td>
					</tr>
				
				{/foreach}
				
				</table>
			
			</div>
		
		{/if}