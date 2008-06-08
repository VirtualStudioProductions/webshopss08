<div id="menuleft">
	<h2 class="hidden">Kategorien-&Uuml;bersicht</h2>
	{foreach from=$categories item=currentCategory} {*Alle Kategorien anzeigen*}
		
		{if $currentCategory.name eq $c_name} {*wir sind bei der ausgewählten Kategorie -> diese auflisten und ihre Unterkategorien mit anzeigen*}
			<div class="category">
				<a href="index.php?site=detail">{$currentCategory.name}</a>
			</div>	
		
			<div class="categoryitem">
				<ul>
				{foreach from=$subcategories item=currentsubcategory}
					<li>{$currentsubcategory.name}</li>
				{/foreach}
				</ul>
			</div>
		{else} {*es handelt sich nicht um die ausgewählte Kategorie, deshalb nur den Kategorienamen anzeigen*}
			<div class="category">
				<a href="index.php?site=detail">{$currentCategory.name}</a>
			</div>	
		{/if}
	{/foreach}

</div>

{* der alte statische testcontent von menuleft.tpl dient als Übersicht, wie das ganze gedacht ist*}
{*
			<div class ="category">
				<a href="index.php?site=detail">ab hier statisch</a>
			</div>
			<div class ="category">
				<a href="index.php?site=detail">Soundkarten</a>
			</div>
			<div class ="category">
				<a href="index.php?site=detail">Arbeitsspeicher</a>
				<div class="categoryitem">
					<ul>
						<li>DDR2-667</li>
						<li>DDR2-800</li>
						<li>DDR2-1066</li>
					</ul>
				</div>
			</div>

			<div class ="category">
				Grafikkarten
				<div class="categoryitem">
					<ul>
						<li>Voodoo Rush</li>
						<li>Voodoo Graphics</li>
						<li>Voodoo2</li>
					</ul>
				</div>
			</div>
*}










				

