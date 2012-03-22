<article class="module width_full">

	<header></header>
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<th class="checkbox"></th> 
			<th>Nome</th> 
			<th>Cidade</th> 
			<th>Eventos</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php
			foreach(Club::getList() as $clubObj):
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="goToPage('club', 'edit', 'clubId', <?php echo $clubObj->getId() ?>)">
			<td><input type="checkbox"></td> 
			<td><?php echo $clubObj->getClubName() ?></td> 
			<td><?php echo $clubObj->getLocation() ?></td> 
			<td><?php echo $clubObj->getEvents() ?></td> 
		</tr> 
		<?php endforeach; ?>
	</tbody> 
	</table>


</article><!-- end of content manager article -->