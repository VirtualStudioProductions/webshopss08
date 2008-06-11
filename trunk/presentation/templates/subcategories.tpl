	
	
	W&auml;hlen Sie eine der folgenden Unterkategorien: ich bin vollverzinst und checke nichts und will nur testens iwe breit hier der text ist bevor er umgebrochen wird weil er sonst zu unleserlich wird...
		<div class="subcategoryitembig">
				<ul>
				{foreach from=$subcategories item=currentSubCategory}
					<li><a href="index.php?site=category&cat={$currentCategory.id}&sub={$currentSubCategory.id}">{$currentSubCategory.name}</a></li>
					{*<li>{$currentSubCategory.name}</li>*}
				{/foreach}
				</ul>
		</div>