<?php

/**
 * Subclasse de construção do componente DhtmlxToolbar.
 * Contém métodos de construção do xml contendo os itens a serem
 * renderizados na toolbar.
 *
 * @package    Research beta
 * @subpackage DhtmlxToolbar30
 * @author     Luciano Stegun
 */
class DhtmlxToolbar extends DhtmlxToolbar30 {

	/**
	 * Método recursivo de recuperação dos itens e respectivos subitens do menu
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Id do módulo que está requisitando os itens da toolbar
	 * @param      String: Nome da action que está requisitando os itens da toolbar
	 * @param      String: Nome real da action que está requisitando a toolbar (Utilizado quando há ums transferência de requisição de uma action para outra)
	 * @param      Array: Lista de itens da toolbar forçados a iniciar desabilitados
	 * @return     String
	 */
	private static function getXmlList( $moduleId, $actionName, $realActionName, $toolbarDisabledList, $mobile, $quickSearch ){

    	$nl = chr(10);
    	
    	$userAdminId  = MyTools::getAttribute('userAdminId');
		$userAdminObj = UserAdminPeer::retrieveByPK( $userAdminId );
		
		if( is_object($userAdminObj) && $userAdminObj->getMaster() )
			$toolbarIdList = 'master';
		else
			$toolbarIdList = UserAdminPeer::loadToolbarPerm( $userAdminId );

		$criteria = new Criteria();
		if( $toolbarIdList!='master' )
			$criteria->add( ToolbarPeer::ID, $toolbarIdList, Criteria::IN );
		$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );

//		$criterion = $criteria->getNewCriterion( ToolbarPeer::ACTION_NAME, $actionName );
//		if( in_array($actionName, array('index', 'create', 'edit', 'view')) )
//			$criterion->addOr( $criteria->getNewCriterion( ToolbarPeer::ACTION_NAME, null ) );
//		$criteria->add($criterion);

		if( !in_array($actionName, array('index', 'create', 'edit', 'view')) )
			$criteria->add( $criteria->getNewCriterion( ToolbarPeer::ACTION_NAME, $actionName ) );
			
		$criteria->add( ToolbarPeer::ENABLED, true );
		$criteria->addAscendingOrderByColumn( ToolbarPeer::ORDER_SEQ );
		$toolbarObjList = ToolbarPeer::doSelect( $criteria );
		
		$xml    = '';
		
		foreach( $toolbarObjList as $key=>$toolbarObj ){
		
			$tagId         = $toolbarObj->getTagId();
			$startDisabled = $toolbarObj->getStartDisabled();
			$visibleAction = $toolbarObj->getVisibleAction();
			
			if( $visibleAction )
				$visibleAction = explode(',', $visibleAction);
				
			$visible = true;
				
//			if( $realActionName=='create' && ($tagId=='edit' || $tagId=='new' || $tagId=='delete') ) $startDisabled = true;
//			if( $realActionName=='edit' && $tagId=='edit' ) $startDisabled = true;
//			if( $realActionName=='view' && $tagId=='save' ) $startDisabled = true;
			if( ($realActionName=='create') && ($tagId=='save' || $tagId=='index') ) $startDisabled = false;
			if( ($realActionName=='create') && ($tagId=='new') ) $startDisabled = true;
			if( ($realActionName=='edit') && ($tagId=='save' || $tagId=='new') ) $startDisabled = false;
			if( $realActionName=='edit' && ($tagId=='delete') ) $startDisabled = false;
			if( $realActionName=='edit' && ($tagId=='index') ) $startDisabled = false;
			if( ($realActionName=='view' || $quickSearch) && ($tagId=='new' || $tagId=='edit' || $tagId=='index' || $tagId=='delete') ) $startDisabled = false;

			$startDisabled = $startDisabled || in_array($tagId, $toolbarDisabledList);
			
			if( $visibleAction && !in_array($realActionName, $visibleAction) )
				$visible = false;
				
			if( ($realActionName=='view') && ($tagId=='view') )  $visible = false;
			if( ($realActionName=='edit') && ($tagId=='view' || $tagId=='edit') )  $visible = false;
			if( ($realActionName=='create') && ($tagId=='view') ) $visible = false;
			if( $quickSearch && $tagId=='view' ) $visible = false;
			if( $quickSearch && ($tagId=='save' || $tagId=='index') ) $visible = true;
			
//			$disabled = ($visible?$startDisabled:true);
//			$disabled = ($disabled?'enabled="false"':'');
			$disabled = ($startDisabled?'enabled="false"':'');
			$visible  = ($visible?'true':'false');
			
			$description = (!$mobile?$toolbarObj->getDescription():'');
			
			if( $mobile && in_array($tagId, array('view', 'show')))
				continue;
			
			$xml .= '	<item id="toolbar'.ucfirst($tagId).'" type="button" img="'.$toolbarObj->getImage().'" visible="'.$visible.'" imgdis="disabled/'.$toolbarObj->getImage().'" text="'.$description.'" '.$disabled.' />'.$nl;
	    	$xml .= '	<item type="separator" visible="'.$visible.'" id="sep'.ucfirst($tagId).'"/>'.$nl;
		}

		return $xml;
	}
	
	/**
	 * Método de contrução do xml a ser utilizado como resultado da toolbar.
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Id do módulo que está requisitando os itens da toolbar
	 * @param      String: Nome da action que está requisitando os itens da toolbar
	 * @param      String: Nome real da action que está requisitando a toolbar (Utilizado quando há ums transferência de requisição de uma action para outra)
	 * @param      String: Lista serializada de itens da toolbar forçados a iniciar desabilitados
	 * @return     String
	 */
	public static function getXml( $moduleId, $actionName, $realActionName, $toolbarDisabledList, $mobile=false ){

		$nl = chr(10);
		
		$toolbarDisabledList = unserialize($toolbarDisabledList);
		$quickSearch         = MyTools::getFlash('quickSearch');
		
    	header('content-type: text/xml; charset=UTF-8');
    	
    	$xml  = '<?xml version="1.0"?>'.$nl;
    	$xml .= '<toolbar>'.$nl;
    	$xml .= self::getXmlList( $moduleId, $actionName, $realActionName, $toolbarDisabledList, $mobile, $quickSearch );
    	$xml .= '</toolbar>';
	    
	    return $xml;
    }
}
?>