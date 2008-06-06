<div id="menuleft">
	<h2 class="hidden">Kategorien-&Uuml;bersicht</h2>
	{foreach from=$categories item=currentCategory}
		<div class="category">
			<a href="index.php?site=detail">{$currentCategory.name}</a>
		</div>	
	{/foreach}


{* der alte content von menuleft.tpl *}

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


</div>








				

