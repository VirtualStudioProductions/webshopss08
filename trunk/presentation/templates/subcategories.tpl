<div>
	<h2>
	{foreach from=$categories item=currentCategory}
		{if $currentCategory.id eq $c_id} {*wir sind bei der ausgewählten Kategorie -> diese anzeigen*}
			Kategorie:&nbsp;{$currentCategory.name}
		{/if}
	{/foreach}

		{foreach from=$subcategories item=currentSubCategory}
			{if $currentSubCategory.id eq $smarty.get.sub}		
			&raquo;&raquo;&raquo;&nbsp;{$currentSubCategory.name} 
			{/if}
		{/foreach}	
	</h2>
</div>

W&auml;hlen Sie eine der folgenden Unterkategorien:


<div id="subcategories">
				
		{foreach from=$subcategories item=currentSubCategory}
					
			<a href="index.php?site=category&amp;cat={$smarty.get.cat}&amp;sub={$currentSubCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentSubCategory.name}">{$currentSubCategory.name}</a> 
			&nbsp;&nbsp;
		{/foreach}
				
</div>
		
{if $smarty.get.sub != null && $subcat_articles != null} {* die Artikeltabelle nur anzeigen, wenn die gewählte Unterkategorie auch Artikel enthält*}
		
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
				<td><a href="index.php?site=article&amp;cat={$smarty.get.cat}&amp;sub={$smarty.get.sub}&amp;arNumber={$currentArticle.number}&amp;handheld={$smarty.get.handheld}" title="{$currentArticle.title}">{$currentArticle.title}</a></td>
				<td>{$currentArticle.description|truncate}</td>
				<td align="center">{$currentArticle.stock}</td>
				<td align="center">{$currentArticle.price} &euro;</td>
			</tr>
				
		{/foreach}
				
		</table>
			
	</div>
{/if}

{if $smarty.get.sub != null && $subcat_articles == null}
	<div>
	Leider sind derzeit keine Artikel in dieser Unterkategorie vorhanden!
	</div>
{/if}


