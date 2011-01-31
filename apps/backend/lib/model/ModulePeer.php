<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'module'.
 *
 * 
 *
 * @package lib.model
 */ 
class ModulePeer extends BaseModulePeer
{

	/**
	 * Método de recuperação de registros a partir do campo EXECUTE_MODULE
	 * da tabela de registros 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Valor do campo a ser pesquisado
	 * @return     Object
	 */	
	public static function retrieveByModuleName( $moduleName, $actionName=null ){
		
		$criteria = new Criteria();
		$criteria->add( ModulePeer::EXECUTE_MODULE, $moduleName );
		if( $actionName )
			$criteria->add( ModulePeer::EXECUTE_ACTION, $actionName );
		$criteria->add( ModulePeer::ENABLED, true );
		$criteria->add( ModulePeer::IS_MENU, true );
		$moduleObj = ModulePeer::doSelectOne( $criteria );
		
		if( !is_object($moduleObj) ){
			
			$criteria->add( ModulePeer::EXECUTE_ACTION, 'index' );
			$moduleObj = ModulePeer::doSelectOne( $criteria );
		}
		
		if( !is_object($moduleObj) ){

			$criteria->remove( ModulePeer::EXECUTE_ACTION );
			$criteria->remove( ModulePeer::IS_MENU );
			$moduleObj = ModulePeer::doSelectOne( $criteria );
		}
		
		if( !is_object($moduleObj) ){
			$moduleObj = new Module();
			$moduleObj->setImageModule('irank.png');
			$moduleObj->setDescription('iRank Manager');
			$moduleObj->setToolbarDescription('iRank Manager');
		}
		
		return $moduleObj;
	}
}
