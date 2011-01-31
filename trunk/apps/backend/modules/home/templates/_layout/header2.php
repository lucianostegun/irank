<div class="systemInfo">ver 2.0.0 rev <?php echo Util::getSvnRevision() ?></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="280"><?php echo link_to(image_tag('layout/logoEsferas2'), '/home') ?></td>
			<td id="mainTopRight" valign="top">
			<?php
				if( $isAuthenticated ):
					
					$keyWord = $sf_params->get('keyWord');
			?>
			<div id="menuObj"></div>
				<div class="userTools2">
					<div class="icon"><?php echo link_to(image_tag('layout/close'), 'login/logout', array('title'=>'Sair do sistema')) ?></div>
					<div class="icon"><?php echo link_to(image_tag('layout/userTools'), 'userTools/edit', array('title'=>'Opções do usuário')) ?></div>
					<div class="quickSearch">
						<?php
							
							echo form_tag( 'quickSearch/index', array(
								'onsubmit'=>'if($("keyWord").value==""){return false}'
							) );
								
							echo input_tag('keyWord', ($keyWord?$keyWord:'Pesquisa rápida'),array('style'=>'width: 120px; border-right: 0px solid', 'onfocus'=>'if(this.value=="Pesquisa rápida"){this.value=""}', 'onblur'=>'if(this.value==""){this.value="Pesquisa rápida"}', 'title'=>'Pesquisa rápida em ocorrências e eventos'));
							echo link_to(image_tag('layout/searchInfo', array('align'=>'absmiddle', 'style'=>'margin-top: -3px; margin-top: 0px !ie')), '#showQuickSearchHint()');
						?>
					</div>
					</form>
					<div id="quickSearchHint" style="display: none">Utilize + para resultados com todas as palavras</div>
					
					<?php if( $isMaster || UserAdmin::checkPermission($userAdminId, Module::getIdByModuleName('task'), 'create' ) ): ?>
					<div class="icon"><?php echo link_to(image_tag('layout/task'), '#addQuickTask()', array('title'=>'Nova tarefa')) ?></div>
					<div class="icon"><?php echo link_to(image_tag('layout/quick'), '#addSuperQuickTask()', array('title'=>'Nova tarefa rápida')) ?></div>
					<?php endif; ?>
					<?php if( $isMaster || UserAdmin::checkPermission($userAdminId, Module::getIdByModuleName('task'), 'edit' ) ): ?>
					<div class="icon"><?php echo link_to(image_tag('layout/clock'), '#getQuickTaskList()', array('title'=>'Controle de execução de tarefas')) ?></div>
					<?php endif; ?>
					<?php if( $isMaster || UserAdmin::checkPermission($userAdminId, Module::getIdByModuleName('phoneControl'), 'create' ) ): ?>
						<div class="icon"><?php echo link_to(image_tag('layout/phoneControl'), '#addQuickPhoneControl()', array('title'=>'Controle de ligações telefônicas')) ?></div>
					<?php endif; ?>
					<div id="taskControlDiv" style="display: none">
						<?php
							$dhtmlxGridObj = new DhtmlxGrid('taskControl');
						
							$dhtmlxGridObj->setHeader( array(
														array('ID',				0,		'left',		'ro',	'int' ),
														array('Status',			50,		'right',	'ro',	'str' ),
														array('#cspan',			120,	'left',		'ro',	'str' ),
														array('Tarefa',			260,	'left',		'ro',	'str' ),
														));
														
							$dhtmlxGridObj->setXmlUrl( '/task/getXml?grid=taskControl' );
							$dhtmlxGridObj->setDoubleClickAction( 'doOpen("task", "view", true, gridboxTaskControlObj)', true );
							$dhtmlxGridObj->setHeight(150);
							$dhtmlxGridObj->build();
						?>
					</div>
				</div>
			<div id="header2">
				<div class="info"><?php echo $dateAndUsername ?></div>
			</div>
			<?php endif; ?>		
	
				</td>
			</td>
		</tr>
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