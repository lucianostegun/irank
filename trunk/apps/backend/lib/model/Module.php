<?php

/**
 * Subclasse de representação de objetos da tabela 'module'.
 *
 * 
 *
 * @package lib.model
 */ 
class Module extends BaseModule
{
	
	public static function getList(){
		
		$userAdminObj = UserAdmin::getCurrentUser();
		
		$criteria = new Criteria();
		$criteria->add( ModulePeer::ENABLED, true );
		$criteria->add( ModulePeer::IS_MENU, true );
		if( !$userAdminObj->getMaster() )
			$criteria->add( ModulePeer::MASTER_ONLY, false );
		
		return ModulePeer::doSelect( $criteria );
	}
	
	public static function getIdByModuleName( $moduleName ){
		
		$criteria = new Criteria();
		
		if( is_array($moduleName) ){
			$criteria->add( ModulePeer::EXECUTE_MODULE, $moduleName, Criteria::IN );
			$moduleObjList = ModulePeer::doSelect( $criteria );
		
			$moduleIdList = array();
			foreach( $moduleObjList as $moduleObj )
				$moduleIdList[] = $moduleObj->getId();
			
			return $moduleIdList;
		}else{
			
			$criteria->add( ModulePeer::EXECUTE_MODULE, $moduleName );
			$moduleObj = ModulePeer::doSelectOne( $criteria );
			
			if( !is_object( $moduleObj ) )
				return null;
				
			return $moduleObj->getId();
		}
	}
	
	private static function getModulePermItens( $modulePermList, $moduleId=null, $level=0, $readOnly, $modulePermGroup ){
	
    	$nl = chr(10);
    	
    	$userAdminObj = UserAdmin::getCurrentUser();
    	
		$criteria = new Criteria();
		$criteria->add( ModulePeer::MODULE_ID, $moduleId );
		$criteria->add( ModulePeer::ENABLED, true );
		$criteria->add( ModulePeer::IS_MENU, true );
		if( !$userAdminObj->getMaster() )
			$criteria->add( ModulePeer::MASTER_ONLY, false );
		$criteria->addAscendingOrderByColumn( ModulePeer::ORDER_SEQ );
		$moduleObjList = ModulePeer::doSelect( $criteria );
		
		require_once ('symfony/helper/HelperHelper.php');
		use_helper('Asset');
		use_helper('Tag');
		use_helper('Form');
		
		$html = '';
		foreach( $moduleObjList as $moduleObj ){
			
			$hasChild = $moduleObj->getHasChild();
			$moduleId = $moduleObj->getId();
			
			$disabledIndex  = (isset($modulePermGroup[$moduleId]['index'])?$modulePermGroup[$moduleId]['index']:false);
			$disabledCreate = (isset($modulePermGroup[$moduleId]['create'])?$modulePermGroup[$moduleId]['create']:false);
			$disabledView   = (isset($modulePermGroup[$moduleId]['view'])?$modulePermGroup[$moduleId]['view']:false);
			$disabledEdit   = (isset($modulePermGroup[$moduleId]['edit'])?$modulePermGroup[$moduleId]['edit']:false);
			$disabledDelete = (isset($modulePermGroup[$moduleId]['delete'])?$modulePermGroup[$moduleId]['delete']:false);
			
			$index  = (isset($modulePermList[$moduleId]['index'])?$modulePermList[$moduleId]['index']:false) || $disabledIndex;
			$create = (isset($modulePermList[$moduleId]['create'])?$modulePermList[$moduleId]['create']:false) || $disabledCreate;
			$view   = (isset($modulePermList[$moduleId]['view'])?$modulePermList[$moduleId]['view']:false) || $disabledView;
			$edit   = (isset($modulePermList[$moduleId]['edit'])?$modulePermList[$moduleId]['edit']:false) || $disabledEdit;
			$delete = (isset($modulePermList[$moduleId]['delete'])?$modulePermList[$moduleId]['delete']:false) || $disabledDelete;
			$all    = ($index && $create && $view && $edit && $delete );
			
			$html .= '	<tr style="height: 23px">'.$nl;
			$html .= '			<td style="width: 300px; text-align: left">';
				
				$html .= str_repeat(image_tag('menu/blank'), ($level>1?$level-1:0));
				if( $level > 0 )
					$html .= image_tag('menu/line', array('align'=>'absmiddle'));
				$html .= image_tag('menu/'.$moduleObj->getImageMenu(), array('align'=>'absmiddle')).'&nbsp;'.$moduleObj->getDescription();
			
			$html .= '</td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('index[]', $moduleId, $index, array('id'=>'index'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'disabled'=>$disabledIndex, 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'index\', this.checked)')).'</div></td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('create[]', $moduleId, $create, array('id'=>'create'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'disabled'=>$disabledCreate, 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'create\', this.checked)')).'</div></td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('view[]', $moduleId, $view, array('id'=>'view'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'disabled'=>$disabledView, 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'view\', this.checked)')).'</div></td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('edit[]', $moduleId, $edit, array('id'=>'edit'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'disabled'=>$disabledEdit, 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'edit\', this.checked)')).'</div></td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('delete[]', $moduleId, $delete, array('id'=>'delete'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'disabled'=>$disabledDelete, 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'delete\', this.checked)')).'</div></td>'.$nl;
			$html .= '			<td style="text-align: left; padding-left: 3px"><div class="checkboxPermDiv" style="'.($readOnly?'display: none':'').'">'.checkbox_tag('all[]', $moduleId, $all, array('id'=>'all'.$moduleId, 'alt'=>$moduleObj->getModuleId(), 'readonly'=>$moduleObj->getHasChild(), 'class'=>'checkboxPerm', 'onclick'=>'checkModulePerm('.$moduleId.', \'all\', this.checked)')).'</div></td>'.$nl;
			$html .= '	</tr>'.$nl;
			
			if( $hasChild )
				$html .= self::getModulePermItens( $modulePermList, $moduleId, ($level+1), $readOnly, $modulePermGroup );
		}
		
		return $html;
	}
	
	public static function getModulePerms( $modulePermList, $readOnly, $modulePermGroup=array() ){

		$nl = chr(10);
		
		$html  = '<table class="modulePerm" cellspacing="3" cellpadding="2">'.$nl;
		$html .= '	<tr>';
		$html .= '		<th style="width: 300px">Módulo</th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllIndex" onclick="checkAllColumn(\'index\', this.checked)"><label for="checkAllIndex" style="float: left; margin: 5 0 0 4">Listar</label></th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllCreate" onclick="checkAllColumn(\'create\', this.checked)"><label for="checkAllCreate" style="float: left; margin: 5 0 0 4">Cadastrar</label></th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllView" onclick="checkAllColumn(\'view\', this.checked)"><label for="checkAllView" style="float: left; margin: 5 0 0 4">Visualizar</label></th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllEdit" onclick="checkAllColumn(\'edit\', this.checked)"><label for="checkAllEdit" style="float: left; margin: 5 0 0 4">Editar</label></th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllDelete" onclick="checkAllColumn(\'delete\', this.checked)"><label for="checkAllDelete" style="float: left; margin: 5 0 0 4">Excluir</label></th>';
		$html .= '		<th nowrap style="width: 100px; text-align: right"><input type="checkbox" style="float: left" id="checkAllAll" onclick="checkAllColumn(\'all\', this.checked)"><label for="checkAllAll" style="float: left; margin: 5 0 0 4">Todos</label></th>';
		$html .= '	</tr>';
		$html .= self::getModulePermItens( $modulePermList, null, 0, $readOnly, $modulePermGroup );
		$html .= '</table>'.$nl;
		
		$moduleObjList = Module::getList();
		$moduleIsList  = array();
		
		foreach( $moduleObjList as $moduleObj )
			$moduleIdList[] = $moduleObj->getId();
			
		$html .= '<input type="hidden" id="moduleIdList" value="'.implode(',', $moduleIdList).'">';
		
		return $html;
	}
}
