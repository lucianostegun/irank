<?php

/**
 * Classe de construção do componente DhtmlxWindows. (Utilizado para construir as janelas de diálogo internas no sistema)
 * Contém os métodos de população e recuperação de parâmetros utilizados
 * na renderização.
 * 
 * Nas chamadas de criação de janelas a classe vai acumulando as informações sobre cada janela em uma variável
 * de sessão que é utilizada para renderizar todas as janelas de uma vez assim que o layout da página é
 * carregada.
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */
class DhtmlxWindows30 {

	private $html = null;

	/**
	 * Método construtor da classe
	 * Cria a instância e define os parâmetros principais do componente e os métodos personalizados
	 * para exibir e ocultar janelas
	 *
	 * @author     Luciano Stegun
	 */	
    public function __construct() {
    
    	$nl = chr(10);
    	
    	$html = '<script>'.$nl;
		$html .= 'var windowsObj = new dhtmlXWindows();'.$nl;
	
		$html .= 'windowsObj.setImagePath("/js/dhtmlx/dhtmlxWindows/imgs/");'.$nl.$nl;
	
		$html .= 'windowsObj.setSkin("dhx_black");'.$nl.$nl;
		$html .= 'windowsObj.attachEvent("onHide", function( windowObj ) {'.$nl.$nl;
	    
		$html .= '    windowObj.setModal( false );'.$nl;
		$html .= '	windowObj.center();'.$nl;
		$html .= '});'.$nl.$nl;
	
		$html .= 'windowsObj.attachEvent("onShow", function( windowObj ) {'.$nl.$nl;

		$html .= '	windowObj.setModal( true );'.$nl;
		$html .= '    windowObj.bringToTop();'.$nl.$nl;

		$html .= '	if( !_isIE ){'.$nl;
		$html .= '	    var topPosition = (window.innerHeight/2-windowObj.getHeight()/2)+document.body.scrollTop;'.$nl;
		$html .= '	    windowObj.setPosition(windowObj.getPosition()[0], topPosition);'.$nl.$nl;
		    
		$html .= '	    divModalCollection    = document.getElementsByClassName("dhx_modal_cover_dv");'.$nl;
		$html .= '	    divModal              = divModalCollection[0];'.$nl;
		$html .= '	    innerHeight           = window.innerHeight;'.$nl;
		$html .= '	    offsetHeight          = document.body.offsetHeight;'.$nl;
		$html .= '	    divModal.style.height = (innerHeight>offsetHeight?innerHeight:offsetHeight);'.$nl;
		$html .= '	}'.$nl.$nl;
		
//		$html .= '	windowObj.center();'.$nl;
		$html .= '	windowObj.denyResize();'.$nl;
		$html .= '});'.$nl.$nl;
		
		$this->html = $html;
    }
    
    /**
	 * Método de renderização do componente.
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir a janela na página
	 *
	 * @author     Luciano Stegun
	 */
    public function build(){
    	
    	$nl = chr(10);
    	
    	$idList = $this->getElementList( 'id' );
    	
    	if( count($idList)==0 )
    		return false;
    		
    	$titleList   = $this->getElementList( 'title' );
    	$widthList   = $this->getElementList( 'width' );
    	$heightList  = $this->getElementList( 'height' );
    	$contentList = $this->getElementList( 'content' );
    	$ajaxList    = $this->getElementList( 'ajax' );
    	$visibleList = $this->getElementList( 'visible' );
    	   	
    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$html = '';
    	for( $i=0; $i < count($idList); $i++ ){

	    	$id      = $idList[$i];
	    	$content = $contentList[$i];
	    	$ajax    = $ajaxList[$i];
	    	
	    	$html .= '<div id="window'.ucfirst($id).'Div">'.($ajax?'':$content).'</div>'.$nl;
    	}

    	echo $html;
    	echo $this->html;
    	
    	$html = '';
    	for( $i=0; $i < count($idList); $i++ ){
    	
	    	$id         = $idList[$i];
	    	$windowName = 'window'.ucfirst($id);
	    	$content    = $contentList[$i];
	    	$title      = $titleList[$i];
	    	$width      = $widthList[$i];
	    	$height     = $heightList[$i];
	    	$ajax       = false;//$ajaxList[$i];
	    	$visible    = $visibleList[$i];
	    	
	    	$html .= '	var '.$windowName.'Loaded = false'.$nl;
	    	
	    	if( $ajax )
				$html .= '	var '.$windowName.'Show   = function( func, focusFieldId ){'.$nl.$nl.
						 '						if(func!=undefined) func();'.$nl.
						 '						showDiv("'.$windowName.'Div");'.$nl.
						 '						'.$nl.
						 '						var successFunc = function(t){'.$nl.
						 '							'.$windowName.'Obj.show();'.$nl.
						 '							if( focusFieldId ) $(focusFieldId).focus()'.$nl.
						 '						}'.$nl.
						 '						'.$nl.
						 '						var urlAjax = \''.$content.'\';'.$nl.
						 '						new Ajax.Updater(\'window'.ucfirst($id).'Div\', urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});'.$nl.
						 '						'.$nl.
						 '					}'.$nl.$nl;
			else
				$html .= '	var '.$windowName.'Show = function( func, focusFieldId ){ if(func!=undefined) func(); showDiv("'.$windowName.'Div");'.$windowName.'Obj.show(); if( focusFieldId ) $(focusFieldId).focus() }'.$nl;
				
			$html .= '	var '.$windowName.'Hide = function(){ '.$windowName.'Obj.hide(); }'.$nl;
				
    		$html .= '	var '.$windowName.'Obj = windowsObj.createWindow(\''.$windowName.'\', 0, 0, '.($width+18).', '.($height+47).');'.$nl;
			$html .= '	'.$windowName.'Obj.button("park").hide();'.$nl;
			$html .= '	'.$windowName.'Obj.button("close").hide();'.$nl;
			$html .= '	'.$windowName.'Obj.button("minmax1").hide();'.$nl;
			
			$html .= '	'.$windowName.'Obj.setText(\''.$title.'\');'.$nl;
			
			if( !$title )
				$html .= '	'.$windowName.'Obj.hideHeader();'.$nl;
				
			$html .= '	'.$windowName.'Obj.attachObject("'.$windowName.'Div");'.$nl;
			if( $visible )
				$html .= '	'.$windowName.'Show();'.$nl;
			else
				$html .= '	'.$windowName.'Obj.hide();'.$nl;
    	}
    	
    	$html .= '</script>'.$nl.$nl;
    	
    	echo $html;
		DhtmlxWindows30::unload();
    }
    
	private function getElementList( $elementId ){
	
		$elementList      = MyTools::getAttribute( 'window'.ucfirst($elementId).'List' );
		$elementList      = unserialize( $elementList );

		return $elementList;
	}
	
	protected static function addElement( $elementId, $value ){
	
		$elementList      = MyTools::getAttribute( 'window'.ucfirst($elementId).'List' );
		$elementList      = unserialize( $elementList );
		$elementList[]    = $value;
		$elementList      = serialize( $elementList );
		
		MyTools::setAttribute( 'window'.ucfirst($elementId).'List', $elementList );
	}	
    
    /**
	 * Método que limpa as variáveis de sessão que armazenam informações sobre as janelas
	 *
	 * @author     Luciano Stegun
	 */
    public static function unload(){
		
		MyTools::getUser()->getAttributeHolder()->remove( 'windowIdList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowTitleList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowWidthList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowHeightList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowContentList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowAjaxList' );
		MyTools::getUser()->getAttributeHolder()->remove( 'windowVisibleList' );
    }
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos de estilo
	 * responsáveis pela aparência do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxWindows/dhtmlxwindows' );
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxWindows/skins/dhtmlxwindows_dhx_black' );
	}
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos javascript
	 * responsáveis pela renderização do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxWindows/dhtmlxwindows' ); 
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcontainer' );
	}
}
?>