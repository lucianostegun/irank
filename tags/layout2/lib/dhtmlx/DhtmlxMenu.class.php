<?php

/**
 * Subclasse de construção do componente DhtmlxMenu.
 * Contém métodos de construção do xml contendo os itens a serem
 * renderizados no menu.
 *
 * @package    Sky SGE
 * @subpackage DhtmlxMenu30
 * @author     Luciano Stegun
 */
class DhtmlxMenu extends DhtmlxMenu30 {

	/**
	 * Método recursivo de recuperação dos itens e respectivos subitens do menu
	 *
	 * @author     Luciano Stegun
	 * @param      Array: [Opcional] Array contendo os ids dos módulos que serão recuperados, de acordo com as permissões do usuário
	 * @param      Array: [Opcional] Id do módulo pai, utilizado na recuperação dos filhos de um módulo em recursividade
	 * @param      Integer: Variável auxiliar que determina a profundidade do nível do menu
	 * @return     String
	 */
	private static function getXmlList( $moduleIdList=array(), $moduleId=null, $level=0 ){
	
    	$nl = chr(10);
    	
		$criteria = new Criteria();
		if( $moduleIdList!='master' )
			$criteria->add( ModulePeer::ID, $moduleIdList, Criteria::IN );
		$criteria->add( ModulePeer::MODULE_ID, $moduleId );
		$criteria->add( ModulePeer::ENABLED, true );
		$criteria->add( ModulePeer::IS_MENU, true );
		$criteria->addAscendingOrderByColumn( ModulePeer::ORDER_SEQ );
		$moduleObjList = ModulePeer::doSelect( $criteria );
		
		$xml = '';
		foreach( $moduleObjList as $moduleObj ){
			
			$hasChild = $moduleObj->getHasChild();
			
			$xml .= str_repeat('	', $level).'<item id="menu'.$moduleObj->getId().'" text="'.$moduleObj->getDescription().'" img="'.$moduleObj->getImageMenu().'"'.(!$hasChild?'/':'').'>'.$nl;
			if( $hasChild ){
				$xml .= self::getXmlList( $moduleIdList, $moduleObj->getId(), ($level+1) );
				$xml .= str_repeat('	', $level).'</item>'.$nl;
			}
		}
		
		return $xml;
	}
	
	/**
	 * Método de contrução do xml a ser utilizado como resultado do menu.
	 *
	 * @author     Luciano Stegun
	 * @return     String
	 */
	public static function getXml(){

		$userAdminId  = MyTools::getAttribute('userAdminId');
		$userAdminObj = UserAdminPeer::retrieveByPK( $userAdminId );
		
		if( is_object($userAdminObj) && $userAdminObj->getMaster() )
			$moduleIdList = 'master';
		else
			$moduleIdList = UserAdminPeer::loadModulePerm( $userAdminId );

    	header('content-type: text/xml; charset=UTF-8');
    	
    	$nl = chr(10);
    	
    	
    	$xml  = '<?xml version="1.0" encoding="UTF-8"?>'.$nl;
		$xml .= '<menu>'.$nl;
		$xml .= self::getXmlList($moduleIdList);
		$xml .= '</menu>';
	    
	    return $xml;
    }
}
?>