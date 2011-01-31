<?php

/**
 * Classe de construção do componente DhtmlxMenu. (Utilizado para construir o menu do sistema)
 * Contém os métodos de população e recuperação de parâmetros utilizados
 * na renderização.
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    Sky SGE
 * @author     Luciano Stegun
 */
class DhtmlxMenu30 {

	/**
	 * Método construtor da classe
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir o menu na página
	 *
	 * @author     Luciano Stegun
	 */
    public function __construct() {
    
    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$nl = chr(10);
    	
    	$html = '<script>'.$nl;
		$html .= 'var menuObj = new dhtmlXMenuObject("menuObj");'.$nl;
		$html .= 'menuObj.setIconsPath("/images/backend/menu/");'.$nl;
		$html .= 'menuObj.loadXML("'.url_for('/home/getXml?model=module').'");'.$nl;
		$html .= 'menuObj.attachEvent("onClick", function(id, zoneId, casState){doMenuAction(id, zoneId, casState)});'.$nl.$nl;
		
		$html .= 'function doMenuAction(id, zoneId, casState){'.$nl.$nl;
	
		$moduleObjList = $this->getModuleList();

		$html .= '	switch( id ){'.$nl;
		
		foreach( $moduleObjList as $moduleObj )
			$html .= '		case \'menu'.$moduleObj->getId().'\': goToModule(\''.$moduleObj->getExecuteModule().'\', \''.$moduleObj->getExecuteAction().'\'); break;'.$nl;
		
		$html .= '	}'.$nl;
		$html .= '}'.$nl;
		$html .= '</script>'.$nl.$nl;
		
		echo $html;
    }
    
    private function getModuleList(){
    	
		$criteria = new Criteria();
		$criteria->add( ModulePeer::EXECUTE_MODULE, null, Criteria::NOT_EQUAL );
		$criteria->add( ModulePeer::IS_MENU, true );
		$criteria->add( ModulePeer::ENABLED, true );
		$moduleObjList = ModulePeer::doSelect( $criteria );
		
		return $moduleObjList;
    }
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos de estilo
	 * responsáveis pela aparência do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxMenu/skins/dhtmlxmenu_dhx_skyblue' );
	}
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos javascript
	 * responsáveis pela renderização do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxMenu/dhtmlxmenu' ); 
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxMenu/ext/dhtmlxmenu_ext' );
	}
}
?>