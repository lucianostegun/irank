<?php

/**
 * Subclasse de construção do componente DhtmlxGrid.
 * Contém métodos de construção do xml e formatação dos dados
 * a serem apresentados no grid
 *
 * @package    Palmares
 * @subpackage DhtmlxGrid30
 * @author     Luciano Stegun
 */
class DhtmlxGrid extends DhtmlxGrid30 {

	/**
	 * Método de contrução do xml a ser utilizado como resultado do grid.
	 * Recebe como parâmetro um array bidimensional
	 *
	 * @author     Luciano Stegun
	 * @param      Array: Array bidimendional sendo a primeiro dimensão como linhas e a segunda como colunas
	 * @param      Array: [Opcional] Array contendo os tipos de dados de cada coluna, utilizado principalmente para converter valores booleanos para imagens
	 * @return     String
	 */
	public static function getXml( $data, $dataType=array() ){

    	header('content-type: text/xml; charset=UTF-8');
    	
    	$nl = chr(10);
    	
    	$xml  = '<?xml version="1.0" encoding="UTF-8"?>'.$nl;
    	$xml .= '<rows>'.$nl;
		
		$columnCount = 0;
		
		$rowId = 1;
	    foreach( $data as $keyRow=>$row ){
	    		
	    	$xml .= '	<row id="'.$rowId++.'">'.$nl;
	    	
	    	foreach( $row as $keyCol=>$cell ){
	    		
	    		$colspan = '';
				if( preg_match('/cspan[0-9]?(.+)\|(.+)/', $cell) ){
					
					list( $first, $last ) = explode( '|', $cell );
					$colspan = ' colspan="'.str_replace('#cspan', '', $first).'"';
					$cell = $last;
				}

	    		$rowspan = '';
				if( preg_match('/rspan[0-9]?(.+)\|(.+)/', $cell) ){
					
					list( $first, $last ) = explode( '|', $cell );
					$rowspan = ' rowspan="'.str_replace('#rspan', '', $first).'"';
					$cell = $last;
				}
				
				$title = null;
				
				if( preg_match('/^\[TITLE: ?.*\]/', $cell) ){
					
					$title = preg_replace('/^\[TITLE: ?/', '', $cell);
					$title = preg_replace('/].*$/', '', $title);
					
					$cell = preg_replace('/^\[TITLE: ?.*\]/', '', $cell);

					$title = ' title="'.$title.'"';
				}
				
				if( isset($dataType[$keyCol]) && $dataType[$keyCol]!==null ){

					$cell = self::formatData( $cell, $dataType[$keyCol] );
				}else{
					
					$translate  = true;
					$cell       = htmlspecialchars($cell);
				}
				
				$xml .= '		<cell id="cell'.$keyRow.'x'.$keyCol.'"'.$colspan.$rowspan.$title.'>'.$cell.'</cell>'.$nl;
	    	}
	    	
			$xml .= '	</row>'.$nl;
	    }

	    $xml .= '</rows>';
	    
	    return $xml;
    }
    
    /**
	 * Método de formatação de dados do resultado de acordo com o tipo
	 *
	 * @author     Luciano Stegun
	 * @param      String: Conteúdo a ser formatado
	 * @param      String: Tipo de formatação desejada como retorno
	 * @return     String
	 */
    public static function formatData( $data, $format ){

    	if( $format=='img' && is_bool($data) )
    		return '/images/backend/'.($data?'':'n').'ok.png';
    }

	public static function convertXmlToArray( $xmlString, $clearLastEmptyRows=false, $zeroTo=null ){
		
		$libDir = sfConfig::get('sf_lib_dir');

		$xmlString     = strip_tags($xmlString, '<?xml><cell><row><rows>');
		$xmlString     = str_replace('<?xml version="1.0"?>', '', $xmlString);
		$xmlString     = '<?xml version="1.0"?>'.$xmlString;

		$xmlString   = simplexml_load_string( $xmlString );
		$returnArray = array();	
		
		if($xmlString){
		
		    $validate = new DOMDocument;
		    $validate->loadXML($xmlString->asXml());
		    
		    $rowList = array();
		    foreach( $xmlString->row as $rowNode ){
		    	
		    	$row = array();
		    	
		    	foreach( $rowNode as $cellNode ){
		    		
		    		$value = (string)$cellNode;
		    		$value = str_replace('R$ ','', $value);
		    		$value = str_replace('R$','', $value);
		    		$value = ($value=='0,00'?$zeroTo:$value);
		    		$value = ($value=='R$ 0,00'?$zeroTo:$value);
		    		$row[] = ($value!==null?$value:null);
		    	}
		    	
		    	$rowList[] = $row;
		    }
		    
		    $returnArray = $rowList;	    
		}
		
		if( $clearLastEmptyRows )
			$returnArray = self::clearLastEmptyRows( $returnArray );
		
		return $returnArray;
	}
	
	public static function convertArrayToXml( $dataArray, $handlerValue=false ){
		
		$xmlString = '<?xml version="1.0" encoding="UTF-8"?><rows>';
		foreach( $dataArray as $keyRow=>$row ){
			
			$xmlString .= '<row id="r'.($keyRow+1).'">';
			foreach( $row as $keyCol=>$cell ){
				
				$value = $cell;
				
				if( $handlerValue )
					eval('$value = '.$handlerValue.'($value, $keyRow, $keyCol );');
				
				$xmlString .= '<cell id="cell'.$keyRow.'x'.$keyCol.'">'.$value.'</cell>';
			}
			
			$xmlString .= '</row>';	
		}
		
		$xmlString .= '</rows>';
		
		return $xmlString;
	}
	
	public static function clearLastEmptyRows( $dataList ){
		
		$dataList = array_reverse( $dataList );
		
		foreach( $dataList as $keyRow=>$row ){
			
			$empty = true;
			foreach( $row as $keyCol=>$col ){
				if( $keyCol > 0 && $col!=null ){
					$empty = false;
					break;
				}
			}
			
			if( $empty )
				unset( $dataList[$keyRow] );
			else
				break;
		}
		
		$dataList = array_reverse( $dataList );
		
		return $dataList;
	}

    /**
     * Compatibilidade com a versão 2.0
     */
    public function setName( $name )
    {
    	
    	$name = preg_replace('/^gridbox/i', '', $name);
    	$this->setId($name);
    	$name = 'gridbox'.ucfirst($name);

        $this->name = $name;
        $this->objectName = $name.'Obj';
    }
    
    public function setHeaders( $headerNameList )
    {
    	
		foreach( $headerNameList as &$headerName )
			$headerName = str_replace('"', '\"', $headerName);
		
		$this->setHeaderNameList( $headerNameList );
    }

    public function setColumnsWidth( $headerWidthList )
    {
		
		$this->setHeaderWidthList( $headerWidthList );           
    }

    public function setColumnsAlign( $headerAlignList )
    {
        $this->setHeaderAlignList( $headerAlignList );
    }

    public function setColumnsTypes( $headerTypeList )
    {
        $this->setHeaderTypeList( $headerTypeList );                 
    }

    public function setColumnsSorting( $headerSortList )
    {
        $this->setHeaderSortList( $headerSortList );                      
    }

    public function setDatabaseSortFields( $headerDBSortList )
    {
        
		$this->setHeaderDBSortList( $headerDBSortList );
    }
    
    public function setEnableDatabaseSort(){
    	
    }

    public function setColumnsColor( $columnsColor )
    {
    	
    	$this->columnsColor = array();
    	foreach( $columnsColor as $columnColor ){

        	if( !$columnColor )
        		$columnColor = '#FFFFFF';

        	$this->columnsColor[] = $columnColor;
    	}                       
    }

    public function setDoubleClick( $jsRedirect, $jsScript=false, $jsNewWindow=false )
    {
    	
    	$this->setDoubleClickAction( $jsRedirect, $jsScript );
    }
    
    public function setXmlFile( $xmlFile )
    {
        $this->setXmlUrl($xmlFile, true );
    }
    
    public function getGrid()
    {
        $this->build();
    }
}
?>