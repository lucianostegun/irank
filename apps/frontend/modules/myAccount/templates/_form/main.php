<?php
	$userSiteId = $userSiteObj->getId();
	$peopleId   = $userSiteObj->getPeopleId();
	$username   = $userSiteObj->getUsername();
	$filePath   = $userSiteObj->getImagePath(true);
	$rankings   = $userSiteObj->getRankingCount();
?>
<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="myAccountUsernameLabel">Username</div>
				<div class="text"><?php echo $username ?></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountEmailAddressLabel">E-mail</div>
				<div class="field"><?php echo input_tag('emailAddress', $userSiteObj->getPeople()->getEmailAddress(), array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'myAccountEmailAddress')) ?></div>
				<div class="error" id="myAccountEmailAddressError" onclick="showFormErrorDetails('myAccount', 'emailAddress')"></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountFirstNameLabel"><?php echo __('sign.form.firstName') ?></div>
				<div class="field"><?php echo input_tag('firstName', $userSiteObj->getPeople()->getFirstName(), array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'myAccountFirstName')) ?></div>
				<div class="error" id="myAccountFirstNameError" onclick="showFormErrorDetails('myAccount', 'firstName')"></div>
			</div>
			<div class="row">
				<div class="label" id="myAccountLastNameLabel"><?php echo __('sign.form.lastName') ?></div>
				<div class="field"><?php echo input_tag('lastName', $userSiteObj->getPeople()->getLastName(), array('size'=>20, 'maxlength'=>25, 'id'=>'myAccountLastName')) ?></div>
				<div class="error" id="myAccountLastNameError" onclick="showFormErrorDetails('myAccount', 'lastName')"></div>
			</div>
			<div class="row" id="passwordChangeRowDiv">
				<div class="label"><?php echo __('sign.form.password') ?></div>
				<div class="text"><?php echo link_to(__('sign.form.changePassword'), '#togglePasswordField()') ?></div>
			</div>
			<div id="passwordAreaDiv"></div>
			
			<!-- I18N -->
			<?php if( empty($rankings) ): ?>
			<div style="width: 350px; border: 5px solid #D7D7D7; margin-top: 30px; margin-left: 30px; line-height: 200%; background: #FFFFFF">
				<div style="border: 1px solid #9F9F9F; padding: 10px">
					Você ainda não está participando de nenhum ranking.<br/>
					<b><?php echo link_to('Clique aqui', 'ranking/new', array('class'=>'red')) ?></b> para criar e compartilhar seu primeiro ranking.
				</div>
			</div>
			<?php endif; ?>
		</td>
		<td width="210" align="center" valign="top">
			<div id="uploadProfilePhotoDiv">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="200" height="260" align="middle">
					<param name="allowScriptAccess" value="always" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="ppid=<?php echo $peopleId ?>&usid=<?php echo $userSiteId ?>&username=<?php echo $username ?>" />
					<param name="movie" value="/uploads/profilePicture.swf?filePath=<?php echo $filePath ?>&ppid=<?php echo $peopleId ?>&usid=<?php echo $userSiteId ?>&username=<?php echo $username ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#E6E6E6" />
					<embed src="/uploads/profilePicture.swf?filePath=<?php echo $filePath ?>&ppid=<?php echo $peopleId ?>&usid=<?php echo $userSiteId ?>&username=<?php echo $username ?>&time=<?php echo time() ?>" quality="high" bgcolor="#E6E6E6" width="200" height="260" border="1" id="uploadProfilePhoto" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
		</td>
	</tr>
</table>
<!-- I18N -->
<?php
	DhtmlxWindows::createWindow('photoCutter', 'Recorte de imagem', 500, 300, 'myAccount/dialog/photoCutter');
?>