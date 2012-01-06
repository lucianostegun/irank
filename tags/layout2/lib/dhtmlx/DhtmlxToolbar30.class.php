<?php

/**
 * Classe de construção do componente DhtmlxToolbar (Utilizado para construir as opções na toolbar de cada módulo)
 * Contém os métodos de população e recuperação de parâmetros utilizados
 * na renderização.
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */
class DhtmlxToolbar30 {

	/**
	 * Método construtor da classe
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir as opções de toolbar na página
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Id do módulo que está requisitando os itens da toolbar
	 * @param      String: Nome da action que está requisitando os itens da toolbar
	 * @param      String: Nome real da action que está requisitando a toolbar (Utilizado quando há ums transferência de requisição de uma action para outra)
	 * @param      Array: Lista de itens da toolbar forçados a iniciar desabilitados
	 */
    public function __construct( $moduleId, $actionName, $realActionName, $toolbarDisabledList=array(), $mobile=false ) {

    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$toolbarDisabledList = serialize($toolbarDisabledList);
    
    	$nl = chr(10);
    	
    	$toolbarUrl = url_for('/home/getXml?model=toolbar&moduleId='.$moduleId.'&actionName='.$actionName.'&realActionName='.$realActionName.'&toolbarDisabledList='.$toolbarDisabledList);

    	$html = '<script>'.$nl;
		$html .= 'var toolbarObj = new dhtmlXToolbarObject("toolbarObj");'.$nl;
		$html .= 'toolbarObj.setIconsPath("/images/backend/toolbar/");'.$nl;
		$html .= 'toolbarObj.setAlign("right");'.$nl;
		$html .= 'toolbarObj.loadXML("'.$toolbarUrl.'");'.$nl;
		$html .= 'toolbarObj.attachEvent("onClick", function(id){doToolbarAction(id)});'.$nl.$nl;
		
		$html .= 'function doToolbarAction(id){'.$nl.$nl;
		$html .= '	if( lockedToolbar() ) return false;'.$nl.$nl;
	
		$toolbarObjList = $this->getToolbarList( $moduleId, $actionName );

		$html .= '	switch( id ){'.$nl;

		foreach( $toolbarObjList as $toolbarObj )
			if( $toolbarObj->getIsJavascript() )
				$html .= '		case \'toolbar'.ucfirst($toolbarObj->getTagId()).'\': '.$toolbarObj->getExecuteAction().'; break;'.$nl;
			else
				$html .= '		case \'toolbar'.ucfirst($toolbarObj->getTagId()).'\': goToModule(\''.$toolbarObj->getExecuteModule().'\', \''.$toolbarObj->getExecuteAction().'\'); break;'.$nl;
				
		$html .= '	}'.$nl;
		$html .= '}'.$nl;
		$html .= '</script>'.$nl.$nl;
		
		echo $html;
    }
    
    private function getToolbarList( $moduleId, $actionName ){
    	
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
		$criterion = $criteria->getNewCriterion( ToolbarPeer::ACTION_NAME, $actionName );
		$criterion->addOr( $criteria->getNewCriterion( ToolbarPeer::ACTION_NAME, null ) );
		$criteria->add($criterion);
		$criteria->add( ToolbarPeer::ENABLED, true );
		$toolbarObjList = ToolbarPeer::doSelect( $criteria );
		
		return $toolbarObjList;
    }
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos de estilo
	 * responsáveis pela aparência do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxToolbar/skins/dhtmlxtoolbar_dhx_skyblue' );
	}
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos javascript
	 * responsáveis pela renderização do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxToolbar/dhtmlxtoolbar' );
	}
}
?>