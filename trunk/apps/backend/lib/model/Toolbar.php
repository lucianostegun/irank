<?php

/**
 * Subclasse de representação de objetos da tabela 'toolbar'.
 *
 * 
 *
 * @package lib.model
 */ 
class Toolbar extends BaseToolbar
{
	
	public static function getToolbarListForPerm( $moduleId, $indexAction, $createAction, $viewAction, $editAction, $deleteAction, $saveAction ){

		$toolbarList = array();
		
		$criteria = new Criteria();
		$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
		$criteria->add( ToolbarPeer::TAG_NAME, 'index' );
		$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );

		if( $viewAction=='true' ){

			$criteria = new Criteria();
			$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
			$criteria->add( ToolbarPeer::EXECUTE_ACTION, 'index', Criteria::NOT_EQUAL );
			$criteria->add( ToolbarPeer::TAG_NAME, array('view', 'cancel', 'search'), Criteria::IN );
			
			$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );			
		}
		
		if( $createAction=='true' ){

			$criteria = new Criteria();
			$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
			$criteria->add( ToolbarPeer::TAG_NAME, 'new' );
			$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );			
		}
		
		if( $editAction=='true' ){
			
			$criteria = new Criteria();
			$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
			$criteria->add( ToolbarPeer::TAG_NAME, 'edit' );
			$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );
		}
		
		if( $createAction=='true' ){

			$criteria = new Criteria();
			$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
			$criteria->add( ToolbarPeer::TAG_NAME, 'save' );
			$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );
		}
		
		if( $deleteAction=='true' ){
			
			$criteria = new Criteria();
			$criteria->add( ToolbarPeer::MODULE_ID, $moduleId );
			$criteria->add( ToolbarPeer::TAG_NAME, 'delete' );
			$toolbarList = array_merge( $toolbarList, ToolbarPeer::doSelect( $criteria ) );
		}
		
		return $toolbarList;
	}
}
