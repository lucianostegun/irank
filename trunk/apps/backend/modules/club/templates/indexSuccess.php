<?php
	echo form_remote_tag(array(
		'url'=>'club/delete',
		'success'=>'handleSuccessClubIndex(request.responseText)',
		'failure'=>'handleFailureClubIndex(request.responseText)',
		'loading'=>'showIndicator("club")',
		'encoding'=>'UTF8',
	), array('id'=>'clubForm'));
?>
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
	<tbody id="clubTbody"> 
		<?php
			$clubIdList = array();
			foreach(Club::getList() as $clubObj):
				
				$clubId       = $clubObj->getId();
				$clubIdList[] = $clubId;
				
				$onclick = 'goToPage(\'club\', \'edit\', \'clubId\', '.$clubId.')"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="clubIdRow-<?php echo $clubId ?>">
			<td><?php echo checkbox_tag('clubId[]', $clubId) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getClubName() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getLocation() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $clubObj->getEvents() ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($clubIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="clubNoRecordsRow">
			<td colspan="4">Nenhum registro disponível para edição</td>
		</tr>
	</tbody> 
	</table>
<?php include_partial('home/include/paginator', array('prefix'=>'club', 'recordCount'=>$recordCount)) ?>
</article><!-- end of content manager article -->
</form>