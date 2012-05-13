<div class="wrapper">
<div class="widget">
	<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Templates de e-mail</h6></div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
	    <thead>
			<tr>
				<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
				<th>Template</th> 
				<th>Template global</th> 
				<th>Arquivo</th> 
			</tr> 
		</thead> 
		<tbody id="emailTemplateTbody"> 
			<?php
				foreach(EmailTemplate::getList() as $emailTemplateObj):
					
					$emailTemplateId = $emailTemplateObj->getId();
					$onclick         = 'goToPage(\'emailTemplate\', \'edit\', \'emailTemplateId\', '.$emailTemplateId.')"';
			?>
			<tr class="gradeA" id="emailTemplateIdRow-<?php echo $emailTemplateId ?>">
				<td><?php echo checkbox_tag('emailTemplateId[]', $emailTemplateId) ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailTemplateObj->getTemplateName() ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $emailTemplateObj->getEmailTemplate()->getTemplateName() ?></td> 
				<td><?php echo link_to($emailTemplateObj->getFile()->getFileName(), '#goToPage("emailTemplate", "downloadFile", "emailTemplateId", '.$emailTemplateObj->getId().')') ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>
