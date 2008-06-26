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

<h3>W&auml;hlen Sie eine der folgenden Unterkategorien:</h3>


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
				<td><a href="index.php?site=article&amp;cat={$smarty.get.cat}&amp;sub={$smarty.get.sub}&amp;arNumber={$currentArticle.number|escape}&amp;handheld={$smarty.get.handheld}" title="{$currentArticle.title|escape}">{$currentArticle.title|escape}</a></td>
				<td>{$currentArticle.description|escape|truncate}</td>
				<td align="center">{$currentArticle.stock|escape}</td>
				<td align="center">{$currentArticle.price|escape} &euro;</td>
			</tr>
				
		{/foreach}
				
		</table>
			
	</div>
{/if}

{if $smarty.get.sub != null && $subcat_articles == null}
	<p>Leider sind derzeit keine Artikel in dieser Unterkategorie vorhanden!</p>
{/if}


