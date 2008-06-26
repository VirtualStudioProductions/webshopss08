<div id="menuleft">
	<h2 class="hidden">Kategorien-&Uuml;bersicht</h2>
	{foreach from=$categories item=currentCategory} {*Alle Kategorien anzeigen*}
		
		{if $currentCategory.id eq $c_id} {*wir sind bei der ausgewählten Kategorie -> diese auflisten und ihre Unterkategorien mit anzeigen*}
			<div class="category">
				<a href="index.php?site=category&amp;cat={$currentCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentCategory.name}">{$currentCategory.name}</a>
			</div>	
		
			<div class="categoryitem">
				<ul>
				{foreach from=$subcategories item=currentSubCategory}
					{if $smarty.get.sub == $currentSubCategory.id} {*wenn schon eine Unterkategorie ausgewählt wurde, diese farbig hinterlegen zur besseren Übersicht*}
						<li><a class="categoryitemselected" href="index.php?site=category&amp;cat={$currentCategory.id}&amp;sub={$currentSubCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentSubCategory.name}">{$currentSubCategory.name}</a></li>
					{else}
						<li><a href="index.php?site=category&amp;cat={$currentCategory.id}&amp;sub={$currentSubCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentSubCategory.name}">{$currentSubCategory.name}</a></li>
					{/if}
				{/foreach}
				</ul>
			</div>
		{else} {*es handelt sich nicht um die ausgewählte Kategorie, deshalb nur den Kategorienamen anzeigen*}
			<div class="category">
				<a href="index.php?site=category&amp;cat={$currentCategory.id}&amp;handheld={$smarty.get.handheld}" title="{$currentCategory.name}">{$currentCategory.name}</a>
			</div>	
		{/if}
	{/foreach}

</div>



	<!-- Begin des Contents -->
	<div id="content">

		<div id="contentwidth">
