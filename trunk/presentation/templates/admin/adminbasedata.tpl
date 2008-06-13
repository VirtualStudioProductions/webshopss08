		<h2>Administration</h2>
		
		<h3>
			<a href="{$smarty.server.PHP_SELF}?site=admin&amp;handheld={$smarty.get.handheld}" title="Zum Administrations-Bereich">Administration</a>
			-&gt; {$baseDataTitle}
			verwalten
		</h3>
		
		<p>Hier k&ouml;nnen Sie neue {$baseDataTitle} hinzuf&uuml;gen und
		bereits bestehende {$baseDataTitle} bearbeiten oder l&ouml;schen.</p>
		
		
		<h4>Neuen {$baseDataTitle} - Datensatz anlegen</h4>
		
		<ul>
			<li><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;new=1&amp;handheld={$smarty.get.handheld}" title="Neuen {$baseDataTitle} - Datensatz anlegen">Neuer {$baseDataTitle} - Datensatz</a></li>
		</ul>
		
		
		<h4>Bestehende {$baseDataTitle} bearbeiten oder l&ouml;schen</h4>
		
		
		{if $smarty.get.basedata == "article"}
		
			<table>
				<tr>
					<th>Nr</th>
					<th>Bezeichnung</th>
					<th>Beschreibung</th>
					<th>Preis</th>
					<th>St&uuml;ck</th>
					<th></th>
					<th></th>
				</tr>
				
				{foreach from=$allBaseData item=currentArticle}
					<tr>
						<td>{$currentArticle.ar_number|escape}</td>
						<td>{$currentArticle.ar_title|escape}</td>
						<td>{$currentArticle.ar_description|escape|truncate:80:" ..."}</td>
						<td align="center" width="100">{$currentArticle.ar_price|escape} &euro;</td>
						<td align="center" width="50">{$currentArticle.ar_stock|escape}</td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;edit=1&amp;ar_id={$currentArticle.ar_id}&amp;handheld={$smarty.get.handheld}" title="Diesen Artikel bearbeiten">Bearb.</a></td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;delete=1&amp;ar_id={$currentArticle.ar_id}&amp;handheld={$smarty.get.handheld}" title="Diesen Artikel l&ouml;schen">L&ouml;schen</a></td>
					</tr>
				{/foreach}
				
			</table>
		
		
		{elseif $smarty.get.basedata == "customer"}
		
			<table>
				<tr>
					<th>Nr</th>
					<th>Username</th>
					<th>E-Mail</th>
					<th>Vorname</th>
					<th>Nachname</th>
					<th>Telefon</th>
					<th>Admin</th>
					<th></th>
					<th></th>
				</tr>
				
				{foreach from=$allBaseData item=currentCustomer}
					<tr>
						<td>{$currentCustomer.cu_number|escape}</td>
						<td>{$currentCustomer.cu_username|escape}</td>
						<td>{$currentCustomer.cu_email|escape}</td>
						<td>{$currentCustomer.cu_firstname|escape}</td>
						<td>{$currentCustomer.cu_lastname|escape}</td>
						<td>{$currentCustomer.cu_phone|escape}</td>
						<td align="center">{$currentCustomer.cu_admin|escape}</td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;edit=1&amp;cu_id={$currentCustomer.cu_id}&amp;handheld={$smarty.get.handheld}" title="Diesen Kunde bearbeiten">Bearb.</a></td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;delete=1&amp;cu_id={$currentCustomer.cu_id}&amp;handheld={$smarty.get.handheld}" title="Diesen Kunde l&ouml;schen">L&ouml;schen</a></td>
					</tr>
				{/foreach}
				
			</table>
		
		
		{elseif $smarty.get.basedata == "category"}
		
			<table>
				<tr>
					<th>Name</th>
					<th></th>
					<th></th>
				</tr>
				
				{foreach from=$allBaseData item=currentCategory}
					<tr>
						<td>{$currentCategory.name|escape:"htmlall"}</td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;edit=1&amp;cat_id={$currentCategory.cat_id}&amp;handheld={$smarty.get.handheld}" title="Diese Kategorie bearbeiten">Bearb.</a></td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;delete=1&amp;cat_id={$currentCategory.cat_id}&amp;handheld={$smarty.get.handheld}" title="Diese Kategorie l&ouml;schen">L&ouml;schen</a></td>
					</tr>
				{/foreach}
				
			</table>
			
		
		{elseif $smarty.get.basedata == "subcategory"}
		
			<table>
				<tr>
					<th>Name</th>
					<th>Ober-Kategorie</th>
					<th></th>
					<th></th>
				</tr>
				
				{foreach from=$allBaseData item=currentSubCategory}
					<tr>
						<td>{$currentSubCategory.sub_name|escape:"htmlall"}</td>
						<td>{$currentSubCategory.cat_name|escape:"htmlall"}</td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;edit=1&amp;sub_id={$currentSubCategory.sub_id}&amp;handheld={$smarty.get.handheld}" title="Diese Unter-Kategorie bearbeiten">Bearb.</a></td>
						<td align="center"><a href="{$smarty.server.PHP_SELF}?site=adminbasedata&amp;basedata={$smarty.get.basedata}&amp;delete=1&amp;sub_id={$currentSubCategory.sub_id}&amp;handheld={$smarty.get.handheld}" title="Diese Unter-Kategorie l&ouml;schen">L&ouml;schen</a></td>
					</tr>
				{/foreach}
				
			</table>
			
		
		{/if}