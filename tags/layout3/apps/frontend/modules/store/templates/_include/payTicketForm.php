	<div class="info"><label>Comprovante:</label>
	<?php
		$fileId      = $purchaseObj->getFileId();
		$orderStatus = $purchaseObj->getOrderStatus();
		$orderNumber = $purchaseObj->getOrderNumber();
		
		$fileName = null;
		if( $fileId )
			$fileName = $purchaseObj->getFile()->getFileName();
		
		echo link_to(truncate_text($fileName, 30, '...', false, true), "#downloadPayTicket($orderNumber)", array('class'=>'pr20 '.($fileId?'':'hidden'), 'title'=>$fileName, 'id'=>'payTicketDownloadLink'));
		
		if( in_array($orderStatus, array('new', 'pending', 'checking', 'canceled')) )
			echo link_to(($fileId?'Reenviar':'Enviar'), "#uploadPayTicket()", array('id'=>'payTicketUploadLink'));
	?>
	</div>
	<?php if( in_array($orderStatus, array('new', 'pending', 'checking', 'canceled')) ): ?>
	<script>
		function submitUploadFileForm(){
			
			$('uploadFileForm').target = 'uploadFileFrame';
			$('uploadFileForm').submit()
		}
	</script>
	<?php
		echo form_remote_tag(array(
			'url'=>'store/uploadFile',
			'encoding'=>'utf8',
			), array('id'=>'uploadFileForm', 'enctype'=>'multipart/form-data'));
			
		echo input_hidden_tag('purchaseId', $purchaseObj->getId());
	?>
	<div id="storePurchaseFileUploadDiv">
		<span class="fileName" id="fileNameLabel">&nbsp;</span>
		<span class="cabinet"><?php echo input_file_tag('filePath', array('onchange'=>'updateFileNameLabel(this.value); submitUploadFileForm()', 'class'=>'file')); ?></span>
		<?php echo button_tag('submitForm', 'ENVIAR', array('onclick'=>'submitUploadFileForm()', 'style'=>'position: relative; left: 5px; top: 0px')) ?>
		<div class="clear"></div>
		<div class="pt10">
			Selecione um arquivo do tipo JPG, PNG ou PDF com até 2Mb
		</div>
	</div>
	
	<iframe border="0" id="uploadFileFrame" name="uploadFileFrame" class="hidden" src="" width="00" height="0" scrolling="no" frameborder="0"></iframe>
	<?php endif; ?>