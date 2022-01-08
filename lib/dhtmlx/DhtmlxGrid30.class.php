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
	private $width            = '100%';
	private $height           = '100%';
	private $style            = '';
	private $headerNameList   = array();
	private $headerWidthList  = array();
	private $headerAlignList  = array();
	private $headerTypeList   = array();
	private $headerSortList   = array();
	private $headerDBSortList = array();
	private $headerHiddenList = array();
	private $headerMaskList   = array();
	private $headerHidden     = array();
	private $extraHeaderList  = array();
	private $footer           = array();
	private $delimiter        = ',';
	private $xmlUrl;
	private $enableMultiSelect    = false;
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
	private $enableColumnMove     = false;
	private $disableSort          = false;
	private $aliasList            = array();
	private $enableRowSpan        = false;
	
    public function __construct($id=''){
    	
    	$this->setId( $id );
    }
    
    public function build(){
    	
    	$nl = chr(10);
    
    	$this->includeStylesheet();
    	$this->includeJavascript();
    	
    	$objectName = $this->getName();
    	$html = '';
		
    	$html .= '<div id="'.str_replace('Obj', 'Div', $objectName).'" style="width: '.$this->getWidth().'; height: '.($this->getHeight(true)).'">'.$nl;
    	
    	$html .= '	<div id="'.$objectName.'" style="width: '.$this->getWidth().'; height: '.$this->getHeight().'; '.$this->getStyle().'"></div>'.$nl.$nl;
    	
    	$html .= '</div>'.$nl;

    	$html .= '<script>'.$nl;
		$html .= '	var '.$objectName.' = new dhtmlXGridObject("'.$objectName.'");'.$nl;
    	$html .= '	'.$objectName.'.setImagePath("/js/dhtmlx/dhtmlxGrid/imgs/");'.$nl;
    	
    	$html .= '	'.$objectName.'.setHeader("'.$this->getHeaderName().'");'.$nl;
		$html .= '	'.$objectName.'.setInitWidths("'.$this->getHeaderWidth().'");'.$nl;
		$html .= '	'.$objectName.'.setColAlign("'.$this->getHeaderAlign().'");'.$nl;
		$html .= '	'.$objectName.'.setColMask("'.$this->getHeaderMask().'");'.$nl;
		$html .= '	'.$objectName.'.setColTypes("'.$this->getHeaderType().'");'.$nl;
		
		if( !$this->disableSort )
			$html .= '	'.$objectName.'.setColSorting("'.$this->getHeaderSort().'");'.$nl;
		
		$html .= '	'.$objectName.'.setNoHeader('.(string)$this->getNoHeader().');'.$nl;
			
    	$html .= '	'.$objectName.'.setDelimiter("'.$this->getDelimiter().'");'.$nl;			
		$html .= '	'.$objectName.'.enableColumnAutoSize(false);'.$nl;		
		$html .= '	'.$objectName.'.setMultiselect('.$this->getEnableMultiSelect().');'.$nl;
		$html .= '	'.$objectName.'.enableMultiline('.(string)$this->getEnableMultiline().');'.$nl;
		
		if( $this->getEnableDragAndDrop() )
			$html .= '	'.$objectName.'.enableDragAndDrop(true);'.$nl;
		$html .= '	'.$objectName.'.getOnLoadDetails = function(){ '.$objectName.'.clearAll()};'.$nl;;
		
		$html .= $this->getExtraHeader();
		$html .= $this->getHandlerList();
		$html .= $this->getColumnComboList();
		
		if( $this->enableRowSpan )
			$html .= '	'.$objectName.'.enableRowspan(true);'.$nl;
			
		$html .= '	'.$objectName.'.enableEditTabOnly(true);'.$nl;
		$html .= '	'.$objectName.'.init();'.$nl;
		$html .= $this->getHiddenColumnList();
    	$html .= '	'.$objectName.'.setSkin("dhx_terrace");'.$nl;
		$html .= $this->getXmlUrl();
		
		        //Habilita DragAndDrop
        if( $this->getEnableDragAndDrop()!=null ){
        	$html .= '	'.$objectName.'.rowToDragElement=function(id){
			            //any custom logic here
			            var text = '.$objectName.'.cells(id,1).getValue(); // prepare a text string
			            return text;
			          }' . $nl;
        	
        }

		foreach($this->aliasList as $alias)
			$html .= '	var gridbox'.ucfirst($alias).'Obj = '.$objectName.';'.$nl;
		
		$html .= '</script>'.$nl.$nl;
		
		echo $html;
    }
    
    /* GETTERS */
    
    private function getId(){
    	
    	return $this->id;
    }
    
    protected function getName(){
    	
    	return 'gridbox'.ucfirst($this->id).'Obj';
    }
	
	private function getWidth(){

		$width = $this->width;
		
		if( is_numeric($width) )
			$width .= 'px';
		
		return $width;
	}
	
	private function getHeight(){

		$height = $this->height;
		
		if( is_numeric($height) )
			$height .= 'px';
			
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
	
	private function getHeaderMask(){
		
		return implode( $this->getDelimiter(), $this->headerMaskList );
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
		$html .= '	'.$this->getName().'.attachEvent("onBeforeSorting", checkIsHeaderFilter);'.$nl.$nl;

		return $html;
	}
	
	private function getDelimiter(){
		
		return $this->delimiter;
	}
	
	private function getXmlUrl(){
		
		$xmlUrl = $this->xmlUrl;
		if( !$xmlUrl )
			return false;
			
		$nl = chr(10);
		
		$gridboxName = ucfirst($this->id);
		
		$html  = $nl.$nl.'	'.$this->getName().'.getXmlUrl = function(objectId, xmlUrlTmp){
			
		var xmlUrl = (xmlUrlTmp?xmlUrlTmp:"'.$xmlUrl.'");

		if( objectId )
			xmlUrl = xmlUrl.replace(/\/?[0-9]*$/, \'/\'+objectId);

		return xmlUrl;
	}
		
	'.$this->getName().'.loadGridbox = function(xmlUrl, objectId){
		
		xmlUrl = (xmlUrl?this.getXmlUrl(objectId, xmlUrl):this.getXmlUrl(objectId));
		this.loadXML(xmlUrl);
	}
	
	'.$this->getName().'.reload = function(){ this.loadGridbox(); }
		
	'.$nl;
		
		$html .= '	'.$this->getName().'.reload();'.$nl;
		
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
    			$html .= '	'.$this->getName() . '.attachEvent("'.$handler['type'].'", '.$functionName.' );'.$nl;
    		}else{
    			$html .= '	'.$this->getName() . '.attachEvent("'.$handler['type'].'", '.$handler['function'].' );'.$nl;
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
	
    protected function setId( $id ){
    	
    	$this->id = $id;
    }
	
	public function setHeader(){
		
		$headerInfoList = func_get_args();
		
		ksort($headerInfoList);

		$headerNameList   = array();
		$headerWidthList  = array();
		$headerAlignList  = array();
		$headerTypeList   = array();
		$headerSortList   = array();
		$headerDBSortList = array();
		$headerHiddenList = array();
		$headerMaskList   = array();

		foreach( $headerInfoList as $key=>$headerInfo ){
			
			$headerNameList[]   = str_replace('"', '\"', $headerInfo[0]);
			$headerWidthList[]  = $headerInfo[1];
			$headerAlignList[]  = $headerInfo[2];
			$headerTypeList[]   = $headerInfo[3];
			$headerSortList[]   = $headerInfo[4];
			$headerDBSortList[] = (isset($headerInfo[5])?$headerInfo[5]:false);
			$headerHiddenList[] = (((isset($headerInfo[6]) && $headerInfo[6]))?true:false);
			$headerMaskList[]   = (isset($headerInfo[7])?$headerInfo[7]:false);
		}
		
		$this->setHeaderNameList( $headerNameList );
		$this->setHeaderWidthList( $headerWidthList );
		$this->setHeaderAlignList( $headerAlignList );
		$this->setHeaderTypeList( $headerTypeList );
		$this->setHeaderSortList( $headerSortList );
		$this->setHeaderDBSortList( $headerDBSortList );
		$this->setHeaderHiddenList( $headerHiddenList );
		$this->setHeaderMaskList( $headerMaskList );
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
	
	protected function setHeaderNameList( $headerNameList ){
		
		$this->headerNameList = $headerNameList;
	}
	
	protected function setHeaderWidthList( $headerWidthList ){
		
		$this->headerWidthList = $headerWidthList;
	}
	
	protected function setHeaderAlignList( $headerAlignList ){
		
		$this->headerAlignList = $headerAlignList;
	}
	
	protected function setHeaderTypeList( $headerTypeList ){
		
		$this->headerTypeList = $headerTypeList;
	}
	
	protected function setHeaderSortList( $headerSortList ){
		
		$this->headerSortList = $headerSortList;
	}
	
	protected function setHeaderDBSortList( $headerDBSortList ){
		
		$this->headerDBSortList = $headerDBSortList;
	}
	
	protected function setHeaderHiddenList( $headerHiddenList ){
		
		$this->headerHidden = $headerHiddenList;
	}

	protected function setHeaderMaskList( $headerMaskList ){
		
		$this->headerMaskList = $headerMaskList;
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
	
    public function setFullHeight($fullHeight=true){
    	
    	$this->fullHeight = $fullHeight;
    }

    public function addFooter( $arr = null, $xleFunction=false )
    {

    	$this->footer[]    = implode( $this->getDelimiter(), $arr );
    	$this->xleFunction = $xleFunction;
    }
    
    public function addColumnCombo( $columnIndex, $optionList ){
    	
    	$this->columnComboList[] = array('columnIndex'=>$columnIndex, 'optionList'=>$optionList);
    }
    
    public function addHandler( $handlerType, $handlerFunction, $ownFunction=false ){
    	
    	$this->handlerList[] = array(	'type'=>$handlerType, 
										'function'=>$handlerFunction, 
										'ownFunction'=>$ownFunction);
    }

    public function addAlias( $alias ){
    	
    	$this->aliasList[] = $alias;
    }
    
    public function addButton( $button ){
    	
    	$this->buttonList[] = $button;
    }
    
    public function enableMultiline(){
    	
    	$this->enableMultiline = true;
    }
    
    public function enableDragAndDrop(){
    	
    	$this->enableDragAndDrop = true;
    }
    
    public function setNoHeader( $noHeader ){
    	
    	$this->noHeader = $noHeader;
    }
    
    public function enableColumnMove(){
    	
    	$this->enableColumnMove = true;
    }
	
	public function disableSort(){
		
		$this->disableSort = true;
	}
	
	public function enableRowspan(){
		
		$this->enableRowSpan = true;
	}
	
	private function includeStylesheet(){
		
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxGrid/dhtmlxgrid' );
		sfContext::getInstance()->getResponse()->addStylesheet( '/js/dhtmlx/dhtmlxGrid/skins/dhtmlxgrid_dhx_terrace' );
	}
	
	private function includeJavascript(){

		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxcommon' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/dhtmlxgrid' );
		sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/dhtmlxgridcell' );
		
		if( $this->getEnableDragAndDrop()!==null )
			sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_drag' );

		if( $this->enableColumnMove )
			sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_mcol' );

		if( $this->enableRowSpan )
			sfContext::getInstance()->getResponse()->addJavascript( 'dhtmlx/dhtmlxGrid/ext/dhtmlxgrid_rowspan' );
	}
}
?>