	
	
	W&auml;hlen Sie eine der folgenden Unterkategorien:
		<div class="subcategoryitembig">
				
				{foreach from=$subcategories item=currentSubCategory}
					<a href="index.php?site=category&amp;cat={$smarty.get.cat}&amp;sub={$currentSubCategory.id}">{$currentSubCategory.name}</a>   :::   
				{/foreach}
				
		</div>
		
		<div>
			<table class="articletable">
				<tr>
					<th>Artikelname</th>
					<th>Artikelbeschreibung</th>
					<th>Lagerbestand</th>
					<th>Preis</th>
				</tr>
			{foreach from=$subcat_articles item=currentArticle}	
				<tr>
					<td><a href="index.php?site=article&arNumber={$currentArticle.number}">{$currentArticle.title}</a></td>
					<td>{$currentArticle.description|truncate}</td>
					<td>{$currentArticle.stock}</td>
					<td>{$currentArticle.price}</td>
				</tr>
			{/foreach}
			</table>
		</div>