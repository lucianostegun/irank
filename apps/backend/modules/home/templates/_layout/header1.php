<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="20%" id="header"><?php echo link_to(image_tag('backend/layout/logo'), '/home') ?></td>
			<td width="55%" id="header"></td>
			<td width="25%" id="header">
				<div class="info">versão 2.0.0 rev <?php echo Util::getSvnRevision() ?></div>
				<div class="info"><?php echo $dateAndUsername ?></div>
			</td>
		</tr>
		<?php
			if( $isAuthenticated ):
				
				$keyWord = $sf_params->get('keyWord');
		?>
		<tr>
			<td colspan="2" valign="top" id="menuObj"></td>
			<td valign="top" class="userTools" style="width: 400px">
				<div class="icon"><?php echo link_to(image_tag('backend/layout/close'), 'login/logout', array('title'=>'Sair do sistema')) ?></div>
				<div class="icon"><?php echo link_to(image_tag('backend/layout/userTools'), 'userTools/edit', array('title'=>'Opções do usuário')) ?></div>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td valign="top" width="20%" class="toolbarDiv">
				<div id="moduleObj"></div>		
			</td>
			<td colspan="2" valign="top" class="toolbarDiv">
				<div id="toolbarObj"></div>			
			</td>
		</tr>
		<?php
			$toolbarDisabledList = (isset($toolbarDisabledList)?$toolbarDisabledList:array());
			$toolbarHideList     = (isset($toolbarHideList)?$toolbarHideList:array());

			new DhtmlxToolbar( $moduleObj->getId(), $actionName, $realActionName, $toolbarDisabledList, $toolbarHideList );
		?>
	</table>