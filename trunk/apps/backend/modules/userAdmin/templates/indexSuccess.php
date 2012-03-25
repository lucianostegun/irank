<?php
	echo form_remote_tag(array(
		'url'=>'userAdmin/delete',
		'success'=>'handleSuccessUserAdminIndex(request.responseText)',
		'failure'=>'handleFailureUserAdminIndex(request.responseText)',
		'loading'=>'showIndicator("userAdmin")',
		'encoding'=>'UTF8',
	), array('id'=>'userAdminForm'));
?>
<article class="module width_full">
	<header></header>
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<th class="checkbox"></th> 
			<th>Nome</th> 
			<th>Clube</th> 
			<th>Último acesso</th> 
			<th>Ativo</th> 
			<th>Master</th> 
		</tr> 
	</thead> 
	<tbody id="userAdminTbody"> 
		<?php
			$userAdminIdList = array();
			foreach(UserAdmin::getList() as $userAdminObj):
				
				$userAdminId       = $userAdminObj->getId();
				$userAdminIdList[] = $userAdminId;
				
				$onclick = 'goToPage(\'userAdmin\', \'edit\', \'userAdminId\', '.$userAdminId.')"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="userAdminIdRow-<?php echo $userAdminId ?>">
			<td><?php echo checkbox_tag('userAdminId[]', $userAdminId) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $userAdminObj->getUsername() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $userAdminObj->getClub()->toString() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $userAdminObj->getLastAccessDate('d/m/Y H:i:s') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $userAdminObj->getActive()?'Sim':'Nao' ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $userAdminObj->getMaster()?'Sim':'Nao' ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($userAdminIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="userAdminNoRecordsRow">
			<td colspan="4">Nenhum registro disponível para edição</td>
		</tr>
	</tbody> 
	</table>
<?php include_partial('home/include/paginator', array('prefix'=>'userAdmin', 'recordCount'=>$recordCount)) ?>
</article><!-- end of content manager article -->
</form>