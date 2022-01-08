<div class="wrapper">
<div class="widget">
	<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>E-mail marketing</h6></div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
	    <thead>
			<tr>
				<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
				<th>Título</th> 
				<th>Template</th> 
				<th>Arquivo</th> 
				<th>Status</th> 
				<th>Último envio</th> 
			</tr> 
		</thead> 
		<tbody id="emailMarketingTbody"> 
			<?php
				foreach(EmailMarketing::getList() as $emailMarketingObj):
					
					$emailMarketingId = $emailMarketingObj->getId();
					$onclick         = 'goToPage(\'emailMarketing\', \'edit\', \'emailMarketingId\', '.$emailMarketingId.')"';
			?>
			<tr class="gradeA" id="emailMarketingIdRow-<?php echo $emailMarketingId ?>">
				<td><?php echo checkbox_tag('emailMarketingId[]', $emailMarketingId) ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailMarketingObj->getDescription() ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailMarketingObj->getEmailTemplate()->toString() ?></td>
				<td><?php echo link_to($emailMarketingObj->getFile()->getFileName(), '#goToPage("emailMarketing", "downloadFile", "emailMarketingId", '.$emailMarketingObj->getId().')') ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailMarketingObj->getSendingStatus(true) ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailMarketingObj->getLastSentDate('-') ?></td> 
			</tr>
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>
