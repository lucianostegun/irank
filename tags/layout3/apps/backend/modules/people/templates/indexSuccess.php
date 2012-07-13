<?php
	
?>
<div class="wrapper">
	<div class="widget">
			<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Usuários</h6></div>                          
			<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
			    <thead>
					<tr>
						<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
						<th>Nome</th> 
						<th>Sobrenome</th> 
						<th>E-mail</th> 
						<th>Telefone</th> 
					</tr>
	            </thead>
				<tbody id="peopleTbody"> 
					<?php
						if( $clubId )
							$peopleObjList = Club::getPlayerList($clubId);
						else
							$peopleObjList = People::getList();
						
						foreach($peopleObjList as $key=>$peopleObj):
							
							$peopleId       = $peopleObj->getId();
							$peopleIdList[] = $peopleId;
							
							$onclick = 'goToPage(\'people\', \'edit\', \'peopleId\', '.$peopleId.')"';
					?>
					<tr class="gradeA" id="peopleIdRow-<?php echo $peopleId ?>">
						<td><input type="checkbox" id="titleCheck<?php echo $key+2 ?>" name="checkRow" /></td> 
						<td onclick="<?php echo $onclick ?>"><?php echo $peopleObj->getFirstName() ?></td> 
						<td onclick="<?php echo $onclick ?>"><?php echo $peopleObj->getLastName() ?></td> 
						<td onclick="<?php echo $onclick ?>"><?php echo $peopleObj->getEmailAddress() ?></td> 
						<td onclick="<?php echo $onclick ?>"><?php echo $peopleObj->getPhoneNumber() ?></td> 
					</tr> 
					<?php endforeach; ?>
				</tbody>
	        </table>  
	    </div>
	</div>
</div>
