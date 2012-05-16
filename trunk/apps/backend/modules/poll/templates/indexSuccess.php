<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Enquetes</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
					<th>Pergunta</th> 
					<th>Data de criação</th> 
				</tr> 
			</thead> 
			<tbody id="clubTbody"> 
				<?php
					foreach(Poll::getList() as $pollObj):
						
						$pollId       = $pollObj->getId();
						$pollIdList[] = $pollId;
						
						$onclick = 'goToPage(\'poll\', \'edit\', \'pollId\', '.$pollId.')"';
				?>
				<tr class="gradeA" id="pollIdRow-<?php echo $pollId ?>">
					<td><?php echo checkbox_tag('pollId[]', $pollId) ?></td>
					<td onclick="<?php echo $onclick ?>"><?php echo $pollObj->getQuestion() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $pollObj->getCreatedAt('d/m/Y H:i:s') ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>