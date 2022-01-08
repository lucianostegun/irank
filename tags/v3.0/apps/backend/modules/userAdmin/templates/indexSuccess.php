<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Usuários administrativos</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
					<th>Nome</th> 
					<th>Usuário</th> 
					<th>E-mail</th> 
					<th>Clube</th> 
					<th>Último acesso</th> 
					<th>Ativo</th> 
					<th>Master</th> 
				</tr> 
			</thead> 
			<tbody id="userAdminTbody"> 
				<?php
					foreach(UserAdmin::getList() as $userAdminObj):
						
						$userAdminId = $userAdminObj->getId();
						
						$onclick = 'goToPage(\'userAdmin\', \'edit\', \'userAdminId\', '.$userAdminId.')"';
				?>
				<tr class="gradeA" onclick="<?php echo $onclick ?>" id="userAdminIdRow-<?php echo $userAdminId ?>">
					<td width="1%"><?php echo checkbox_tag('userAdminId[]', $userAdminId) ?></td> 
					<td width="20%"><?php echo $userAdminObj->getPeople()->getName() ?></td> 
					<td width="10%"><?php echo $userAdminObj->getUsername() ?></td> 
					<td width="20%"><?php echo $userAdminObj->getPeople()->getEmailAddress() ?></td> 
					<td width="15%" class="center"><?php echo $userAdminObj->getClub()->toString() ?></td> 
					<td width="12%" class="center"><?php echo $userAdminObj->getLastAccessDate('d/m/Y H:i') ?></td> 
					<td width="8%" class="center"><?php echo $userAdminObj->getActive()?'Sim':'Nao' ?></td> 
					<td width="8%" class="center"><?php echo $userAdminObj->getMaster()?'Sim':'Nao' ?></td> 
				</tr> 
				<?php endforeach; ?>
			</tbody> 
		</table>
	</div>
</div>
