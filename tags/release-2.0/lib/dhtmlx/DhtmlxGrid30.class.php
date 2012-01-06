<?php

/**
 * Classe de construção do componente DhtmlxGrid (Apresentação de dados, utilizado nas listagens de  módulos)
 * Contém os métodos de população e recuperação de parâmetros utilizados
 * na renderização.
 * 
 * Site/Documentação do componente: www.dhtmlx.com
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */ 
class DhtmlxGrid30 {

	private $id;
	private $width             = '100%';
	private $height            = '100%';
	private $style             = '';
	private $headerNameList    = array();
	private $headerWidth       = array();
	private $headerAlign       = array();
	private $headerType        = array();
	private $headerSort        = array();
	private $headerDBSort      = array();
	private $headerHidden      = array();
	private $extraHeaderList   = false;
	private $delimiter         = ',';
	private $xmlUrl;
	private $enableMultiSelect    = false;
	private $doubleClickAction    = false;
	private $handlerList          = array();
    private $enableMultiline      = false;
    private $enableDragAndDrop    = null;
    private $noHeader             = false;
	private $columnComboList      = array();
	private $buttonList           = array();
	private $fullHeight           = false;
	private $paginator            = false;
	private $searchOptions        = false;
	private $searchOptionsContent = null;
	
	/**
	 * Método construtor da classe
	 *
	 * @author     Luciano Stegun
	 * @param      String: Id do grid, deve ser único na página
	 */
    public function __construct( $id='', $search=false, $paginator=false ){
    	
    	$this->setId( $id );
    	
    	if( !$id ){
    		
    		$search    = true;
    		$paginator = 'main';
    	}

    	$this->setSearchOptions( $search );
    	$this->setPaginator( $paginator );
    }
    
    /**
	 * Método de renderização do componente.
	 * Reúne todos os parâmetros e gera o retorno javascript responsável
	 * por construir o grid na página
	 *
	 * @author     Luciano Stegun
	 * @return     String
	 */
    public function build(){
    	
    	$nl = chr(10);
    
    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$objectName = $this->getName();
    	$html = '';
		
    	$html .= '<div style="width: '.$this->getWidth().'; height: '.($this->getHeight(true)).'">'.$nl;
		if( $this->getSearchOptions()){
	    	
	    	$html .= '	<div class="gridboxSearchOptionBar" style="width: '.($this->getWidth()).'; height: 32px">'.$nl;
	    	$html .= '		'.button_tag('updateGridboxSearch', 'Pesquisar', array('onclick'=>'updateGridboxSearch("'.$this->getId().'", false, 0)', 'style'=>'margin: 5px')).''.$nl.$nl;
	    	$html .= '		'.button_tag('exportGridboxSearch', 'Exportar', array('onclick'=>'doExport("excel")', 'image'=>'excel', 'style'=>'margin: 5px')).''.$nl.$nl;
	    	foreach( $this->getButtonList() as $button )
	    		$html .= '		'.$button.$nl.$nl;	
	    	$html .= '		'.$this->getSearchOptionsContent().$nl.$nl;	
	    	$html .= '	</div>'.$nl.$nl;
		}
    	
    	$html .= '	<div id="'.$objectName.'" style="width: '.$this->getWidth().'; height: '.$this->getHeight().'; '.$this->getStyle().'"></div>'.$nl.$nl;
    	
    	if( $this->getPaginator() ){
	    	
	    	$instanceName = ucfirst($this->getId());
	    	
	    	$html .= '	<div class="gridboxPaginatorBar" id="paginator'.$instanceName.'" style="width: '.($this->getWidth()).'">'.$nl;
	    	$html .= '		<table width="100%" style="margin: 5px" class="paginator">'.$nl.$nl;
	    	$html .= '			<tr>'.$nl.$nl;
	    	$html .= '				<td width="30%" class="paginatorDiv" id="paginator'.$instanceName.'Div"></td>'.$nl.$nl;
	    	$html .= '				<td width="20%" class="totalPagesDiv" id="totalPages'.$instanceName.'Div"></td>'.$nl.$nl;
	    	$html .= '				<td width="20%" class="totalRecordsDiv" id="totalRecords'.$instanceName.'Div"></td>'.$nl.$nl;
	    	$html .= '				<td width="30%" class="pageLimitDiv" id="pageLimit'.$instanceName.'Div"></td>'.$nl.$nl;
	    	$html .= '			</tr>'.$nl.$nl;
	    	$html .= '		</table>'.$nl.$nl;
	    	$html .= '	</div>'.$nl.$nl;
    	}
    	
    	$html .= '</div>'.$nl;

    	$html .= '<script>'.$nl;
		$html .= '	var '.$objectName.' = new dhtmlXGridObject("'.$objectName.'");'.$nl;
    	$html .= '	'.$objectName.'.setImagePath("/js/dhtmlx/dhtmlxGrid/imgs/");'.$nl;
    	
    	$html .= '	'.$objectName.'.setHeader("'.$this->getHeaderName().'");'.$nl;
		$html .= '	'.$objectName.'.setInitWidths("'.$this->getHeaderWidth().'");'.$nl;
		$html .= '	'.$objectName.'.setColAlign("'.$this->getHeaderAlign().'");'.$nl;
		$html .= '	'.$objectName.'.setColTypes("'.$this->getHeaderType().'");'.$nl;
		$html .= '	'.$objectName.'.setColSorting("'.$this->getHeaderSort().'");'.$nl;
		$html .= '	'.$objectName.'.setNoHeader('.(string)$this->getNoHeader().');'.$nl;
			

    	$html .= '	'.$objectName.'.setDelimiter("'.$this->getDelimiter().'");'.$nl;			
		$html .= '	'.$objectName.'.enableColumnAutoSize(false);'.$nl;		
		$html .= '	'.$objectName.'.setMultiselect('.$this->getEnableMultiSelect().');'.$nl;
		
		if( $this->getEnableMultiline() )
			$html .= '	'.$objectName.'.enableMultiline(true);'.$nl;
		if( $this->getEnableDragAndDrop() )
			$html .= '	'.$objectName.'.enableDragAndDrop(true);'.$nl;
		$html .= '	'.$objectName.'.getOnLoadDetails = function(){ '.$objectName.'.clearAll()};'.$nl;;
		
		$html .= $this->getExtraHeader();
		$html .= $this->getDBSort();
		$html .= $this->getHandlerList();
		$html .= $this->getColumnComboList();
		$html .= $this->getDoubleClickAction();
		
		$html .= '	'.$objectName.'.enableCollSpan(true);'.$nl;
		$html .= '	'.$objectName.'.enableEditTabOnly(true);'.$nl;
		$html .= '	'.$objectName.'.init();'.$nl;
		$html .= $this->getHiddenColumnList();
    	$html .= '	'.$objectName.'.setSkin("dhx_blue");'.$nl;
		$html .= $this->getXmlUrl();
		
		        //Habilita DragAndDrop
        if( $this->getEnableDragAndDrop()!=null ){
        	$html .= $objectName.'.rowToDragElement=function(id){
			            //any custom logic here
			            var text = '.$objectName.'.cells(id,1).getValue(); // prepare a text string
			            return text;
			          }' . $nl;
        	
        }

		if( $this->getFullHeight() )
			$html .= 'adjustGridboxHeight("'.$objectName.'", "'.$this->getPaginator().'", '.($this->getSearchOptions()?'true':'false').')'.$nl;
		
		$html .= '</script>'.$nl.$nl;
		
		echo $html;
    }
	
    
    /* GETTERS */
    
    private function getId(){
    	
    	return $this->id;
    }
    
    private function getName(){
    	
    	return 'gridbox'.ucfirst($this->id).'Obj';
    }
	
	private function getWidth(){

		return $this->width;
	}
	
	private function getHeight($area=false){

		$height = $this->height;
		if( $height==null ){
			
			$height = MyTools::getAttribute('screenHeight');
			$decrase = Util::getBrowser('IE')?140:120;
			$height = (($height*1)-$decrase);	
		}
		
		if( $area && $this->getSearchOptions() && $this->getPaginator() )
			$height += 50;
			
		return $height;
	}
	
	private function getStyle(){

		return $this->style;
	}

	private function getHeaderName(){

		return implode( $this->getDelimiter(), $this->headerNameList );
	}
	
	private function getHeaderWidth(){
		
		return implode( $this->getDelimiter(), $this->headerWidthList );
	}
	
	private function getHeaderAlign(){
		
		return implode( $this->getDelimiter(), $this->headerAlignList );
	}
	
	private function getHeaderType(){
		
		return implode( $this->getDelimiter(), $this->headerTypeList );
	}
	
	private function getHeaderSort(){
		
		return implode( $this->getDelimiter(), $this->headerSortList );
	}
	
	private function getHeaderDBSort(){
		
		return implode( '\''.$this->getDelimiter().'\'', $this->headerDBSortList );
	}
    
    public function getEnableMultiline(){
    	
    	return $this->enableMultiline;
    }
    
    public function getEnableDragAndDrop(){
    	
    	return $this->enableDragAndDrop;
    }
    
    private function getNoHeader(){
    	
    	return $this->noHeader;
    }
	
	private function getExtraHeader(){

		$nl = chr(10);
		
		$extraHeaderList = $this->extraHeaderList;
		if( !$extraHeaderList )
			return false;
			
		$html  = '	'.$this->getName().'.attachHeader("'.implode($this->getDelimiter(), $extraHeaderList ).'");'.$nl;
		$html .= '	'.$this->getName().'.setSizes();'.$nl;
		$html .= '	'.$this->getName().'.attachEvent("onBeforeSorting", checkIsHeaderFilter);';

		return $html;
	}
	
	private function getDBSort(){
		
		if( !$this->getHeaderDBSort() )
			return false;

		$nl = chr(10);
		
		$html  = 'var _DatabaseSortField = false;'.$nl;
	    $html .= 'var _DatabaseSortDesc  = false;'.$nl.$nl;
	    	
	    $html .= 'function onBeforeSort(columnIndex){
			        
	var instanceName = $("instanceName").value;			        
			        
    if( $(instanceName+"DatabaseSortField")==null ) return true;

    if( !checkIsHeaderFilter() )
    	return false;
    
    var sortFields = [\''. $this->getHeaderDBSort().'\'];
    if( _DatabaseSortField == sortFields[columnIndex] && _DatabaseSortDesc==false )
        _DatabaseSortDesc=true;
    else
        _DatabaseSortDesc=false;
    _DatabaseSortField = sortFields[columnIndex];
    $(instanceName+"DatabaseSortField").value = _DatabaseSortField;
    $(instanceName+"DatabaseSortDesc").value  = (_DatabaseSortDesc?1:"");
    
    if( _DatabaseSortField!="" )    	
    	updateGridboxSearch(instanceName)

    return true;
}

'.$this->getName().'.attachEvent("onBeforeSorting", onBeforeSort);';
			    
		return $html;
	}
	
	private function getDelimiter(){
		
		return $this->delimiter;
	}
	
	public function getXmlUrl(){
		
		$xmlUrl = $this->xmlUrl;
		if( !$xmlUrl )
			return false;
			
		$nl = chr(10);
		
		$gridboxName = ucfirst($this->id);
		
		$html  = 'function getXmlUrl'.$gridboxName.'(){
			return "'.$xmlUrl.'";
		}
		
		function loadGridbox'.$gridboxName.'(xmlUrl){
			'.$this->getName().'.loadXML((xmlUrl?xmlUrl:getXmlUrl'.$gridboxName.'()), startLoadingGridbox( '.$this->getName().' ));
		}
		
		'.$nl;
		
		$html .= 'loadGridbox'.$gridboxName.'();';
		return $html;
	}
	
	private function getHiddenColumnList(){
	
		$headerHiddenList = $this->headerHidden;

		$html = '';
		foreach( $headerHiddenList as $key=>$headerHidden )
			if( $headerHidden==true )
				$html .= $this->getName().'.setColumnHidden('.$key.', true);'.chr(10);
		
		return $html;
	}
	
	public function getEnableMultiSelect(){
		
		return (string)$this->enableMultiSelect;
	}
	
    private function getDoubleClickAction()
    {
        
        return $this->doubleClickAction;
    }
    
    public function getColumnComboList(){
    	
    	$columnComboList = $this->columnComboList;
    	$gridName        = $this->getName();
    	$html = '';
    	foreach( $columnComboList as $columnCombo ){
    	
    		$varName = $gridName.'Combo'.$columnCombo['columnIndex'];
    		$html .= 'var '.$varName.' = '.$gridName.'.getCombo( '.$columnCombo['columnIndex'].' );'.chr(10);
    		
    		foreach( $columnCombo['optionList'] as $key=>$value )	
    			$html .= $varName.'.put( "'.$key.'", "'.$value.'" );'.chr(10);
    	}
    	
    	return $html;
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
    
    public function getButtonList(){
    	
    	return $this->buttonList;
    }
	
    public function getSearchOptions(){
    	
    	return $this->searchOptions;
    }
	
    private function getSearchOptionsContent(){
    	
    	return $this->searchOptionsContent;
    }
	
    public function getPaginator(){
    	
    	return $this->paginator;
    }
	
    public function getFullHeight(){
    	
    	return $this->fullHeight;
    }
    
    
        
    /* SETTERS */
	
    private function setId( $id ){
    	
    	$this->id = $id;
    }
	
	public function setHeader( $headerInfoList ){

		ksort($headerInfoList);

		$headerNameList   = array();
		$headerWidthList  = array();
		$headerAlignList  = array();
		$headerTypeList   = array();
		$headerSortList   = array();
		$headerDBSortList = array();
		$headerHiddenList = array();

		foreach( $headerInfoList as $key=>$headerInfo ){
			
			$headerNameList[]   = str_replace('"', '\"', $headerInfo[0]);
			$headerWidthList[]  = $headerInfo[1];
			$headerAlignList[]  = $headerInfo[2];
			$headerTypeList[]   = $headerInfo[3];
			$headerSortList[]   = $headerInfo[4];
			$headerDBSortList[] = (isset($headerInfo[5])?$headerInfo[5]:false);
			$headerHiddenList[] = (((isset($headerInfo[6]) && $headerInfo[6]))?true:false);
		}
		
		$this->setHeaderNameList( $headerNameList );
		$this->setHeaderWidthList( $headerWidthList );
		$this->setHeaderAlignList( $headerAlignList );
		$this->setHeaderTypeList( $headerTypeList );
		$this->setHeaderSortList( $headerSortList );
		$this->setHeaderDBSortList( $headerDBSortList );
		$this->setHeaderHiddenList( $headerHiddenList );
	}
	
	public function setExtraHeader( $extraHeaderList ){
	
		foreach( $extraHeaderList as $key=>$extraHeader )
			$extraHeaderList[$key] = str_repeat('&nbsp;', (($extraHeader[0]!='#')?3:0)).str_replace('"', '\"', $extraHeader);

		$this->extraHeaderList = $extraHeaderList;
	}
	
	public function setWidth( $width ){
		
		$this->width = $width;
	}
	
	public function setHeight( $height ){
		
		$this->height = $height;
	}
	
	public function setStyle( $style ){
		
		$this->style = $style;
	}
	
	private function setHeaderNameList( $headerNameList ){
		
		$this->headerNameList = $headerNameList;
	}
	
	private function setHeaderWidthList( $headerWidthList ){
		
		$this->headerWidthList = $headerWidthList;
	}
	
	private function setHeaderAlignList( $headerAlignList ){
		
		$this->headerAlignList = $headerAlignList;
	}
	
	private function setHeaderTypeList( $headerTypeList ){
		
		$this->headerTypeList = $headerTypeList;
	}
	
	private function setHeaderSortList( $headerSortList ){
		
		$this->headerSortList = $headerSortList;
	}
	
	private function setHeaderDBSortList( $headerDBSortList ){
		
		$this->headerDBSortList = $headerDBSortList;
	}
	
	private function setHeaderHiddenList( $headerHiddenList ){
		
		$this->headerHidden = $headerHiddenList;
	}
	
	public function setDelimiter( $delimiter ){
		
		$this->delimiter = $delimiter;
	}
	
	public function setXmlUrl( $xmlUrl, $noScriptName=false ){
		
		if( !$noScriptName )
			$xmlUrl = MyTools::urlFor($xmlUrl);

		$this->xmlUrl = $xmlUrl;
	}
	
	public function setEnableMultiSelect( $enableMultiSelect=true ){
		
		$this->enableMultiSelect = $enableMultiSelect;
	}
	
	public function enableMultiSelect(){
		
		$this->setEnableMultiSelect(true);
	}
	
    public function setDoubleClickAction( $doubleClickAction, $isJavascript=false, $openNewWindow=false )
    {
        
        $objectName   = $this->getName();
        $objectNameUc = ucfirst( $objectName );
        
        if( !$isJavascript )
        	if( $openNewWindow )
	        	$doubleClickAction = 'window.open("' . url_for($doubleClickAction) . '/" + '.$objectName.'.cells('.$objectName.'.getSelectedId(), 0).getValue())';
	        else
	        	$doubleClickAction = 'window.location="' . url_for($doubleClickAction) . '/" + '.$objectName.'.cells('.$objectName.'.getSelectedId(), 0).getValue()';
    	
        $html = '
		        function doOnCellEdit'.$objectNameUc.'( rowId, cellId ) {
		        	'.$doubleClickAction.';
		        }   	
	    	 
	        	'.$objectName.'.attachEvent("onRowDblClicked", doOnCellEdit'.$objectNameUc.' );';
        
        $this->doubleClickAction = $html;
    }
	
    private function setSearchOptions( $searchOptions ){
    	
    	$this->searchOptions = $searchOptions;
    }
	
    public function setSearchOptionsContent( $searchOptionsContent ){
    	
    	$this->searchOptionsContent = $searchOptionsContent;
    }
	
    private function setPaginator( $paginator ){
    	
    	$this->paginator = $paginator;
    	
    	if( $paginator ){
    		
    		sfContext::getInstance()->getResponse()->addStylesheet( '/css/backend/paginator' );
			sfContext::getInstance()->getResponse()->addJavascript( '/js/backend/paginator' );
    	}
    }
	
    public function setFullHeight($fullHeight=true){
    	
    	$this->fullHeight = $fullHeight;
    }
    
    /**
	 * Método que manipula a criação de colunas no grid cujo tipo é uma lista
	 * drop down para seleção do usuário
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Índice da coluna que receberá o dropdown
	 * @param      Array: Lista de opções do dropdown
	 */
    public function addColumnCombo( $columnIndex, $optionList ){
    	
    	$this->columnComboList[] = array('columnIndex'=>$columnIndex, 'optionList'=>$optionList);
    }
    
    /**
	 * Método de controle de manipulações de eventos.
	 * Popula um array de eventos que contêm informações sobre o que vai acontecer
	 * quando um determinado evento ocorrer no grid
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
    
    /**
	 * Método que adiciona botões à barra de pesquisa do grid
	 *
	 * @author     Luciano Stegun
	 */
    public function addButton( $button ){
    	
    	$this->buttonList[] = $button;
    }
    
    public function enableMultiline(){
    	
    	$this->enableMultiline = true;
    }
    
    public function enableDragAndDrop($enabled=true){
    	
    	$this->enableDragAndDrop = $enabled;
    }
    
    public function setNoHeader( $noHeader ){
    	
    	$this->noHeader = $noHeader;
    }
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos de estilo
	 * responsáveis pela aparência do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxGrid/dhtmlxgrid' );
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxGrid/skins/dhtmlxgrid_dhx_blue' );
	}
	
	/**
	 * Método que requisita ao framework a inclusão dos arquivos javascript
	 * responsáveis pela renderização do componente
	 *
	 * @author     Luciano Stegun
	 */
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/dhtmlxgrid' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_srnd' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_filter' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/dhtmlxgridcell' );
		
		if( $this->getEnableDragAndDrop()!==null )
			sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_drag' );
	}
}
?>