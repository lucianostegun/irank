<?php

/**
 * Classe de construção do componente DhtmlxTabbar. (Organização de dados por abas, utilizado nas telas de criação, edição e visualização dos módulos)
 * Contém os métodos de população e recuperação de parâmetros utilizados
 * na renderização.
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */
class DhtmlxTabBar30 {

	private $id;
	private $tabBarObjList    = array();
	private $selectedTabBarId = null;
	private $height           = '98%';
	private $handlerList       = array();
	
	/**
	 * Método construtor da classe
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir as abas na página
	 *
	 * @author     Luciano Stegun
	 * @param      String: Id do grupo de abas, deve ser único na página
	 */
    public function __construct( $id ) {
    
    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$this->setId( $id );
    }
    
    /**
	 * Método de renderização do componente.
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir as abas na página
	 *
	 * @author     Luciano Stegun
	 */
    public function build(){
    	
    	$nl = chr(10);
    	
    	$objectName = $this->getName();
    	
    	$html  = '<div id="'.$objectName.'Div" style="margin-top: 1px; height: '.$this->getHeight().'px;"></div>'.$nl;
    	$html .= $this->getTabBarListContent();
    	$html .= '<script>'.$nl;
		$html .= '    '.$objectName.' = new dhtmlXTabBar("'.$objectName.'Div", "top");'.$nl;

    	$html .= '    '.$objectName.'.setHrefMode("ajax-html");'.$nl;
    	$html .= '    '.$objectName.'.setSkin("dhx_black");'.$nl;
		$html .= '    '.$objectName.'.setImagePath("/js/dhtmlx/dhtmlxTabbar/imgs/");'.$nl;

		$html .= $this->getTabBarListScript();
		$html .= $this->getHandlerList();

		$html .= '    '.$objectName.'.enableAutoSize(true, true);'.$nl;
//		$html .= '    '.$objectName.'.attachEvent("onTabContentLoaded", onTabContentLoaded);'.$nl;
    
    	$html .= '    '.$objectName.'.setTabActive(\''.$this->getSelectedTabBarId().'\');'.$nl.$nl;
    	$html .= '    window.onload = adjustContentTab;'.$nl.$nl;
		$html .= '</script>'.$nl.$nl;
		
		echo $html;
    }
	
    /**
	 * Adiciona uma aba a ser exibida na página
	 *
	 * @author     Luciano Stegun
	 * @param      String: Id da aba, deve ser única dentro do grupo de abas
	 * @param      String: Nome da aba a ser exibida na página
	 * @param      String: Conteúdo da aba
	 * @param      Array: [Opcional] Array de parâmetros opcionais
	 */
	public function addTab( $id, $description, $content, $options=array() ){
			
		$width     = false;
		$overflowY = 'hidden';
		$hidden    = false;
		$ajax      = false;
		$style     = null;

		if( isset($options['width']))     $width     = $options['width'];		// Define o tamanho do nome da aba
		if( isset($options['overflowY'])) $overflowY = $options['overflowY'];	// Define se a aba terá ou não barra de rolagens (auto: sim, hidden: não)]
		if( isset($options['hidden']))    $hidden    = $options['hidden'];	    // Define se a aba iniciará invisível
		if( isset($options['ajax']))      $ajax      = $options['ajax'];	    // Define se a aba será carregada apenas quando clicar nela
		if( isset($options['style']))     $style     = $options['style'];	    // Define o estilo da área da aba

		if( $this->getTabBarCount()==0 )
			$this->setSelectedTabBarId($id);

		$tabBarObj = new TabBar();
		$tabBarObj->setId( $id );
		$tabBarObj->setAjax( $ajax );
		$tabBarObj->setStyle( $style );
		$tabBarObj->setDescription( $description );
		$tabBarObj->setWidth( $width );
		$tabBarObj->setHidden( $hidden );
		$tabBarObj->setContent( $content, $options );
		$tabBarObj->setOverflowY( $overflowY );
		
		$this->tabBarObjList[] = $tabBarObj;
	}
	
	private function getTabBarCount(){
		
		return count($this->tabBarObjList);
	}
	
    
    /* GETTERS */
	
	private function getSelectedTabBarId(){
		
		return $this->selectedTabBarId;
	}
    
    private function getTabBarListContent(){
    	
    	$nl = chr(10);
    	
    	$html = '';

    	foreach( $this->tabBarObjList as $tabBarObj )
    		if( !$tabBarObj->isAjax() )
    			$html .= '<div '.$tabBarObj->getStyle().' id="'.$this->getId().$tabBarObj->getName().'Div">'.$tabBarObj->getContent().'&nbsp;</div>'.$nl;
    		else
    			$html .= '<div '.$tabBarObj->getStyle().' id="'.$this->getId().$tabBarObj->getName().'Div"></div>'.$nl;
    	
    	return $html;
    }
    
    private function getTabBarListScript(){
    	
    	$nl = chr(10);
    	
    	$objectName = $this->getName();
    	
    	$html = '';
    	
    	foreach( $this->tabBarObjList as $tabBarObj ){
	    
	    	$html .= '    '.$objectName.'.addTab("'.$tabBarObj->getId().'", "'.$tabBarObj->getDescription().'", "'.$tabBarObj->getWidth().'px");'.$nl;
	    	
	    	if( $tabBarObj->isAjax() )
	    		$html .= '    '.$objectName.'.setContentHref(\''.$tabBarObj->getId().'\',\''.$tabBarObj->getContent().'\');'.$nl;
	    	else
	    		$html .= '    '.$objectName.'.setContent(\''.$tabBarObj->getId().'\',\''.$this->getId().$tabBarObj->getName().'Div\');'.$nl;
	    	
	    	if( $tabBarObj->getHidden() )
	    		$html .= '    '.$objectName.'.hideTab(\''.$tabBarObj->getId().'\',true);'.$nl;
    	}
    	
    	return $html;
    }
    
    private function getId(){
    	
    	return $this->id;
    }
    
    private function getName(){
    	
    	return 'tabBar'.ucfirst($this->id).'Obj';
    }
    
    private function getHeight(){
    	
    	return $this->height;
    }
    
    public function getHandlerList(){
    	
    	$nl = chr(10);
    	
    	$handlerList = $this->handlerList;

    	if( !$handlerList )
    		return false;
    	
    	$html = '';
    	
    	foreach( $handlerList as $handler )
    		
    		if( $handler['ownFunction'] ){
    			
    			$functionName = $this->getName().'_'.$handler['type'];
    			
    			$html .= 'var '.$functionName.' = function(){'.$handler['function'].';}'.$nl;
    			$html .= $this->getName() . '.attachEvent("'.$handler['type'].'", '.$functionName.' );'.$nl;
    		}else{
    			$html .= $this->getName() . '.attachEvent("'.$handler['type'].'", '.$handler['function'].' );'.$nl;
    		}

    	return $html;
    }
	
	
    
    /**
	 * Método de controle de manipulações de eventos.
	 * Popula um array de eventos que contêm informações sobre o que vai acontecer
	 * quando um determinado evento ocorrer na tab
	 *
	 * @author     Luciano Stegun
	 * @param      String: Tipo de evento, podendo ser todos aqueles definidos na documentação do do componente
	 * @param      String: Função manipuladora executada quando o evento for disparado, deve ser somente o nome de uma função já criada
	 * @param      String: [Opcional] Trecho de código de uma função javascript a ser executada quando o evento for disparado. 
	 * 						Utilizada quando a função necessita ser criada dinamicamente
	 */
    public function addHandler( $handlerType, $handlerFunction, $ownFunction=false ){
    	
    	$this->handlerList[] = array(	'type'=>$handlerType, 
										'function'=>$handlerFunction, 
										'ownFunction'=>$ownFunction);
    }
    
        
    /* SETTERS */
	
	private function setSelectedTabBarId( $selectedTabBarId ){
		
		if( !$selectedTabBarId )
			return false;
			
		if( $this->selectedTabBarId )
			return false;

		$selectedTabBarId = str_replace('Obj', '', $selectedTabBarId);
		
		$this->selectedTabBarId = $selectedTabBarId;
	}
	
    private function setId( $id ){
    	
    	$this->id = $id;
    }
    
    public function setHeight( $height ){
    	
    	$this->height = $height;
    }
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos de estilo
	 * responsáveis pela aparência do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxTabbar/dhtmlxtabbar' );
	}
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos javascript
	 * responsáveis pela renderização do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxTabbar/dhtmlxtabbar' );
	}
}


/**
 * Subclasse de construção das abas que serão utilizadas pelo módulo DhtmlxTabBar
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    TaskManager 2.0
 * @subpackage DhtmlxTabbar
 * @author     Luciano Stegun
 */
class TabBar {
	
	private $id;
	private $description;
	private $width;
	private $height;
	private $hidden;
	private $content;
	private $overflowY = 'auto';
	private $ajax      = false;
	private $style     = null;
	
	/* GETTERS */
	public function getName(){
		
		return ucfirst($this->id).'Obj';
	}
	
	public function getId(){
		
		return $this->id;
	}
	
	public function getDescription(){
		
		return $this->description;
	}
	
	public function getWidth(){
		
		return $this->width;
	}
	
	public function getHeight(){
		
		return $this->height;
	}
	
	public function getContent(){
		
		return $this->content;
	}
	
	public function getCustomWidth(){
		
		$description = $this->getDescription();
		$description = String::removeAccents( $description );
		
		$map = array(	'a'=>8, 'b'=>8, 'c'=>8, 'd'=>8, 'e'=>8, 'f'=>8, 'g'=>8, 'h'=>8, 'i'=>8, 'j'=>8, 'k'=>8, 'l'=>8, 'm'=>8, 'n'=>8, 'o'=>8, 'p'=>8, 'q'=>8, 'r'=>8, 's'=>8, 't'=>8, 'u'=>8, 'v'=>8, 'w'=>8, 'x'=>8, 'y'=>8, 'z'=>8, 
						'A'=>11, 'B'=>11, 'C'=>11, 'D'=>11, 'E'=>11, 'F'=>11, 'G'=>11, 'H'=>11, 'I'=>11, 'J'=>11, 'K'=>11, 'L'=>11, 'M'=>11, 'N'=>11, 'O'=>11, 'P'=>11, 'Q'=>11, 'R'=>11, 'S'=>11, 'T'=>11, 'U'=>11, 'V'=>11, 'W'=>11, 'X'=>11, 'Y'=>11, 'Z'=>11, 
						'0'=>8, '1'=>6, '2'=>7, '3'=>7, '4'=>9, '5'=>8, '6'=>9, '7'=>9, '8'=>9, '9'=>9, ' '=>4);
		
		$width = 0;
		
		for( $i=0; $i < strlen($description) ; $i++ )
			if( isset($map[$description[$i]]))
				$width += $map[$description[$i]];
			else
				$width += 8;
		
		return ($width+10);
	}
	
	public function getOverflowY(){
		
		return $this->overflowY;
	}
	
	public function getHidden(){
		
		return $this->hidden;
	}
	
	public function getStyle(){
		
		$style = $this->style;
		if( $style )
			$style = 'style="'.$style.'"';
		
		return $style;
	}
	
	public function isAjax(){
		
		return $this->ajax;
	}
	
	
	/* SETTERS */
	public function setId( $id ){
		
		$this->id = $id;
	}
	
	public function setDescription( $description ){
		
		$this->description = $description;
	}
	
	public function setWidth( $width ){
		
		if( !$width )
			$width = $this->getCustomWidth();
		$this->width = $width;
	}
	
	public function setHeight( $height ){

		$this->height = $height;
	}
	
	public function setContent( $content, $options=array() ){
		
		$scriptName = MyTools::getRequest()->getScriptName();
		
		if( !$this->isAjax() )
			$content = get_partial($content, $options);
		else
			$content = $scriptName.'/home/getTab?tabAddress='.$content.'&options='.serialize($options);
			
		$this->content = $content;
	}
	
	public function setOverflowY( $overflowY ){
		
		$this->overflowY = $overflowY;
	}
	
	public function setHidden( $hidden ){
		
		$this->hidden = $hidden;
	}
	
	public function setAjax( $ajax ){
		
		$this->ajax = $ajax;
	}
	
	public function setStyle( $style ){
		
		$this->style = $style;
	}
}
?>