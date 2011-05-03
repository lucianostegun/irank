<?php

/**
 * Subclasse de construção do componente DhtmlxGrid.
 * Contém métodos de construção do xml e formatação dos dados
 * a serem apresentados no grid
 *
 * @package    TaskManager 2.0
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
		
		
		$request      = MyTools::getRequest();
	    $exportType   = $request->getParameter('exportType');
	    $headerList   = $request->getParameter('headerList');
	    $instanceName = $request->getParameter('instanceName');
	    
	    if( $exportType=='excel' )
    		return DhtmlxGrid::exportExcel( $data, $dataType, $headerList, $instanceName );

    	header('content-type: text/xml; charset=UTF-8');
    	
    	$nl = chr(10);
    	
    	$xml  = '<?xml version="1.0"?>'.$nl;
    	$xml .= '<rows>'.$nl;
		
		$columnCount = 0;
		
		$rowId = 1;
	    foreach( $data as $keyRow=>$row ){
	    		
	    	$xml .= '	<row id="'.$rowId++.'">'.$nl;
	    	
	    	foreach( $row as $keyCol=>$cell ){
	    		
	    		$colspan = '';
				if( ereg('cspan[0-9]?(.+)\|(.+)', $cell) ){
					
					list( $first, $last ) = explode( '|', $cell );
					$colspan = ' colspan="'.str_replace('#cspan', '', $first).'"';
					$cell = $last;
				}
				
				if( isset($dataType[$keyCol]) && $dataType[$keyCol]!==null ){

					$cell = self::formatData( $cell, $dataType[$keyCol] );
				}else{
					
					$translate  = true;
					$cell       = htmlspecialchars($cell);
				}
				
				$xml .= '		<cell id="cell'.$keyRow.'x'.$keyCol.'"'.$colspan.'>'.$cell.'</cell>'.$nl;
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
    		return '/images/'.($data?'':'n').'ok.png';
    }

	public static function convertXmlToArray( $xmlString, $clearLastEmptyRows=false, $zeroTo=null ){
		
		$libDir = sfConfig::get('sf_lib_dir');

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
	
	public static function exportExcel( $dataList, $dataType, $headerList, $moduleName=null ){
    	
    	$webDir = sfConfig::get('sf_web_dir');
    	
    	$inputFilePath  = $webDir.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'gridboxExport.xls';
		$outputFilePath = $webDir.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR.'gridExport'.DIRECTORY_SEPARATOR.'gridboxExport-'.microtime().'.xls';
	
		$phpExcelObj = PHPExcel_IOFactory::load($inputFilePath);
						
		$currentLine = 4;
		$isDebug = Util::isDebug();

		$headerList = explode(',', $headerList);
		if( !$isDebug )
			unset($headerList[0]);
			
		$phpExcelObj->setActiveSheetIndex(0)
						->setCellValue('E7', count($dataList) );
		
		
		if( $moduleName ){
		
			$moduleObj = ModulePeer::retrieveByModuleName($moduleName);
			
			if( is_object($moduleObj) )
				$phpExcelObj->setActiveSheetIndex(0)
							->setCellValue('A2', $moduleObj->getToolbarDescription() );	
		}
		
		$columnCount  = count($headerList)-5;
		$columnLetter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
		
		if( $columnCount > 0 )
			$phpExcelObj->setActiveSheetIndex(0)->insertNewColumnBefore('B', $columnCount);
			
		foreach( $headerList as $columnIndex=>$header ){
			
			$column = $columnLetter[$columnIndex-($isDebug?0:1)];
			
			if( $header=='#cspan' )						
				$phpExcelObj->setActiveSheetIndex(0)
						->mergeCells($columnLetter[$columnIndex-2].'3:'.$columnLetter[$columnIndex-1].'3', $header );
			else
				$phpExcelObj->setActiveSheetIndex(0)
						->setCellValue($column.'3', $header )
						->getColumnDimension($column)->setAutoSize(true);
		}
		
		$phpExcelObj->setActiveSheetIndex(0)
						->mergeCells('A2:'.$columnLetter[$columnIndex].'2', $header );
						
		$styleArray = array('font'=>array('bold'=>true),
							'borders'=>array('bottom'=>array('style'=>PHPExcel_Style_Border::BORDER_MEDIUM)));
		$phpExcelObj->setActiveSheetIndex(0)->getStyle('A3:'.$columnLetter[$columnIndex-1].'3')->applyFromArray($styleArray);
		
		$styleArray = array('borders'=>array('top'=>array('style'=>PHPExcel_Style_Border::BORDER_MEDIUM),
											'bottom'=>array('style'=>PHPExcel_Style_Border::BORDER_MEDIUM)));
												
		$phpExcelObj->setActiveSheetIndex(0)->getStyle('A7:'.$columnLetter[$columnIndex-1].'7')->applyFromArray($styleArray);
						
		$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(count($dataList), 5);
		
		foreach( $dataList as $data){
			
			if( !$isDebug )
				unset($data[0]);
			
			foreach( $data as $columnIndex=>$value )
				$phpExcelObj->setActiveSheetIndex(0)
							->setCellValue($columnLetter[$columnIndex-($isDebug?0:1)].$currentLine, $value );
			
			$phpExcelObj->setActiveSheetIndex(0)->insertNewRowBefore(++$currentLine, 1);
		}
		
		Util::headerExcel('export.xls');
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcelObj, 'Excel5');
		$objWriter->save( $outputFilePath );
		
		$fileContent = file_get_contents( $outputFilePath );
    	print_r($fileContent);
    	unlink($outputFilePath);
    	exit;
    }
}
?>