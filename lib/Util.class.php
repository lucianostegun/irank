<?php

/**
 * Classe com diversos métodos utilitários que auxiliam o desenvolvimento 
 *
 * @package    TaskManager 2.0
 * @author     Luciano Stegun
 */
class Util {

	const AUTO_COMPLETE_SUGGEST_NEW = 1;
	const AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY = 2;

	/**
	 * Método responsável por criar e retornar um nobo objeto de uma
	 * determinada classe de acordo com o parâmetro.
	 * Utilizado no cadastro de novos registros dos módulos regulares 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Nome da classe da qual será gerado um noo objeto
	 * @param      Array: Array bidimensional contendo a lista de campos obrigatórios na tabela que 
	 * 				precisam ser preenchidos para que o registro seja salvo
	 * @return     Object
	 */
	public static function getNewObject( $className, $requiredFieldList=array() ){
		
		$className = ucfirst($className);
		$classNamePeer = $className.'Peer';
		
		$criteria = new Criteria();
		$criteria->setNoFilter(true);
		eval('$criteria->add( '.$classNamePeer.'::LOCKED, false );');
		eval('$criteria->add( '.$classNamePeer.'::ENABLED, false );');
		eval('$criteria->add( '.$classNamePeer.'::DELETED, false );');
		eval('$criteria->add( '.$classNamePeer.'::VISIBLE, false );');
		eval('$criteria->add( '.$classNamePeer.'::CREATED_AT, time()-86400, Criteria::LESS_EQUAL );');
		eval('$criteria->addAscendingOrderByColumn( '.$classNamePeer.'::CREATED_AT );');
		eval('$newObj = '.$classNamePeer.'::doSelectOne( $criteria );');
		
		$newObj = null;
		
		if( is_object($newObj) ){
			
			$newObj->setLocked( true );
			$newObj->setCreatedAt( time() );
			$newObj->setUpdatedAt( time() );
		}else{
		
			$newObj = new $className();
			$newObj->setVisible( false );
			$newObj->setEnabled( false );
			$newObj->setDeleted( false );
		}
		
		foreach($requiredFieldList as $key=>$requiredField){
			
			$funcName = 'set'.ucfirst($key);
			$newObj->$funcName($requiredField);
		}
			
		$newObj->save();
		
		if( method_exists($newObj, 'setActive') )
			$newObj->setActive(true);
	
		if( method_exists($newObj, 'cleanRecord'))
			$newObj->cleanRecord();
		
		return $newObj;
	}
	
	/**
	 * Método que força o envio de um cabeçalho de erro ao browser
	 * simulando um erro de processamento no servidor 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Mensagem a ser exibida no erro
	 * @param      Boolean: Define se o processamento deve ser interrompido assim que a mensagem for enviada
	 */
	public static function forceError( $errorDescription=null, $exit=true ){
	
		header( 'HTTP/1.1 500 Internal Server Error' );
		
		echo $errorDescription;
		
		if( $exit )
			exit;
	}
	
	/**
	 * Método que executa uma consulta direta ao banco sem a necessidade
	 * da utilização da classe Criteria.
	 * Retorna um objeto ResultSet com o resultado da consulta
	 *
	 * @author     Luciano Stegun
	 * @param      String: Comando SQL a ser executado na base de dados, deve ser um comando único
	 * @return     Object: ResultSet
	 */
	public static function executeQuery($query, $con=null, $connectionName=null){
		
		if( is_null($con) )
			$con = Propel::getConnection($connectionName);
		
    	$statement  = $con->prepareStatement( $query );
    	$resultset  = $statement->executeQuery($query, ResultSet::FETCHMODE_NUM);
    	
    	return $resultset;
	}
	
	/**
	 * Método que executa uma consulta direta ao banco sem a necessidade
	 * da utilização da classe Criteria.
	 * Retorna um objeto ResultSet com o resultado da consulta
	 *
	 * @author     Luciano Stegun
	 * @param      String: Comando SQL a ser executado na base de dados, deve ser um comando único
	 * @return     Object: ResultSet
	 */
	public static function executeOne( $query, $returnType='int' ){

		$resultset  = self::executeQuery($query);
    	
    	$function = 'get'.ucfirst($returnType);
    	
    	while( $resultset->next() )
    		return $resultset->$function(1);
	}
	
	/**
	 * Método responsável realizar a consulta ao banco de dados e retornar
	 * uma lista contendo os IDs e labels dos resultados em um formato aceito
	 * pelo campo de autocomplete nativo do framework 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Tabela onde será realizada a consulta
	 * @param      String: Campo chave primária que será utilizada como ID do elemento resultante
	 * @param      String: Campo de descrição que será utilizado como label do elemento resultante
	 * @param      String: Trecho de comando SQL contendo a condição de consulta ao banco
	 * @param      String: Trecho de comando SQL contendo a ordenação da consulta ao banco
	 * @param      String: Nome da instância que está realizando a pesquisa, para o caso de duas 
	 * 				consultas autocomplete retornarem registros com o mesmo ID
	 * @return     String
	 */
	public static function getAutoCompleteResults( $table, $fieldId, $fieldName, $condition, $fieldOrder, $instanceName, $options=array() ){
		
		$suggestNew = array_key_exists('suggestNew', $options)?$options['suggestNew']:false;
		$quickName  = array_key_exists('quickName', $options)?$options['quickName']:null;
		$jquery     = array_key_exists('jquery', $options)?$options['jquery']:false;
		$fieldValue = array_key_exists('fieldValue', $options)?$options['fieldValue']:$fieldName;
		
		$sql = "SELECT $fieldId, $fieldName, $fieldValue FROM $table WHERE $condition ORDER BY $fieldOrder";
		
	    $resultSet = self::executeQuery( $sql );
	    
	    if( $jquery ){
	    	
		   header('content-type: application/json; charset=UTF-8');
		   $resultList = array();
		   
			while( $resultSet->next() ){
		
				$id    = $resultSet->getInt(1);
				$label = $resultSet->getString(2);
				$value = $resultSet->getString(3);
				$resultList[] = '{"id":"'.$id.'", "label": "'.$label.'", "value": "'.$value.'"}';    	
		    }

			if( ($suggestNew==self::AUTO_COMPLETE_SUGGEST_NEW && $quickName) ||
				($suggestNew==self::AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY && $resultSet->getRecordCount()==0 && $quickName) )
				$resultList[] = '{"id":"quickNew", "label": "Criar novo: '.$quickName.'", "value": "'.$quickName.'"}';
		
			return '['.implode(', ', $resultList).']';
	    }else{
	    
		    $li = chr(10);
		    
		    $result = '<ul>'.$li;
			
			while( $resultSet->next() ){
		
				$id   = $resultSet->getInt(1);
				$name = $resultSet->getString(2);
				$result .= '	<li id="'.$instanceName.$id.'">'.$name.'</li>'.$li;    	
		    }
			
			if( $suggestNew==self::AUTO_COMPLETE_SUGGEST_NEW && $quickName )
				$result .= '	<li id="quickNew"><b>Criar novo: </b>'.$quickName.'</li>'.$li;
			else if( $suggestNew==self::AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY && $resultSet->getRecordCount()==0 && $quickName )
				$result .= '	<li id="quickNew"><b>Criar novo: </b>'.$quickName.'</li>'.$li;
				    	
		    $result .= '</ul>';
	    }
	    
	    return $result;
	}
	
	/**
	 * Método responsável por incluir as mensagens de erro e sucesso
	 * nas páginas de cadastro/edição de registros dos módulos regulares 
	 *
	 * @author     Luciano Stegun
	 * @return     Boolean 
	 */
	public static function isDebug($returnString=false){
		
		$request  = MyTools::getRequest();
		$isDebug1 = (sfConfig::get('sf_environment')=='dev');
		$isDebug2 = ($request->getParameter('debug')=='1');
		
		$isDebug = ($isDebug1 || $isDebug2);
		
		return ($returnString?($isDebug?'1':'0'):$isDebug);
	}
	
	/**
	 * Método responsável por formatar uma data no formato desejado independente
	 * do formato de entrada 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Data no formato de entrada
	 * @param      String: Tipo de destino da data (Obsoleto)
	 * @param      String: Formato desejado da data de saída
	 * @return     String: Data no formato desejado
	 */	
	public static function formatDate( $date, $destination='database', $format='Y-m-d' ){
		
		$date = substr( $date, 0, 10 );
		
		if( $destination=='database' ){
			
			if( ereg('^[0-9]{2}-[0-9]{2}-[0-9]{4}$', $date) )
				return $date;
				
			$dateArray = explode( '/', $date );
			if( is_array( $dateArray ) && count( $dateArray )==3 ){
				list( $day, $month, $year ) = $dateArray;

				return date($format, mktime(0,0,0,$month,$day,$year));
			}
			if( is_array( $dateArray ) && count( $dateArray )==2 ){
				list( $day, $month ) = $dateArray;
				
				return $month.'-'.$day;
			}elseif( $date=strtotime($date)){
				
				return date($format, $date);
			}else{
				
				return null;
			}
		}elseif( $destination=='screen' ){
			
			$dateArray = explode( '-', $date );
			if( is_array( $dateArray ) && count( $dateArray )==3 ){
				list( $year, $month, $day ) = $dateArray;
				
				return $day.'/'.$month.'/'.$year;
			}
		}
		
		return $date;
	}
	
	/**
	 * Método responsável por formatar uma hora no formato desejado independente
	 * do formato de entrada
	 *
	 * @author     Luciano Stegun
	 * @param      String: Hora no formato de entrada
	 * @param      String: Tipo de destino da hora
	 * @return     String: Hora no formato desejado
	 */	
	public static function formatDateTime( $dateTime, $format='database', $dateFormat='Y-m-d' ){

		if( !ereg('^[0-9]{2}/[0-9]{2}/[0-9]{4} [0-9]{2}:[0-9]{2}(:[0-9]{2})?$', $dateTime) )
			if( !ereg('^[0-9]{2}/[0-9]{2}/[0-9]{4} ?$', $dateTime) )
				return null;
			else
				$dateTime = trim($dateTime).' 00:00:00';
				

		$dateTime = explode( ' ', $dateTime );

		$time = '';
		$date = '';
		
		if( count( $dateTime ) >= 1 )
			$date = substr( $dateTime[0], 0, 10 );
		else
			return null;
			
		if( count( $dateTime ) == 2 )
			$time = substr( $dateTime[1], 0, 8 );
		
		if( $format=='database' ){
			
			$dateArray = explode( '/', $date );
			if( is_array( $dateArray ) && count( $dateArray )==3 ){
			
				list( $day, $month, $year ) = $dateArray;
				
				$date = strtotime($year.'-'.$month.'-'.$day);
				$date = date($dateFormat, $date);
			}
		}elseif( $format=='screen' ){
			
			$dateArray = explode( '-', $date );
			
			if( is_array( $dateArray ) && count( $dateArray )==3 ){
			
				list( $year, $month, $day ) = $dateArray;
				
				$date = $day.'/'.$month.'/'.$year;
			}
		}
		
		return trim( $date.' '.$time );
	}
	
	/**
	 * Método responsável por converter uma string para um valor decimal
	 * ou um valor decimal em uma string para apresentação de dados.
	 * Por padrão tenta converter uma string para um valor decimal
	 *
	 * @author     Luciano Stegun
	 * @param      String/Float: String ou Valor a ser convertido
	 * @param      Boolean: Define se a conversão será feita para exibição de dados 
	 * @return     String/Float: Valor formatado no formato desejado
	 */	
	public static function formatFloat( $value, $display=false, $decimalPlaces=2 ){
	
		$culture = MyTools::getCulture();
		
		if( $display ){
			
			$value = self::formatFloat($value, false, $decimalPlaces);
			
			if( $culture=='pt_BR' )
				$value = number_format($value, $decimalPlaces, ',', '.');
			else
				$value = number_format($value, $decimalPlaces, '.', ',');
		}else{
			
			if( ereg('^[0-9]+\.[0-9]{1,2}$', $value) )		
				$value = str_replace( '.', ',', $value );
		
		
			if( !is_float($value) ){
				
				$value = str_replace( ' ', '', $value );
				$value = str_replace( '.', '', $value );
				$value = str_replace( ',', '.', $value );
				
				$value = $value*1.0;
			}else{
				
				$value = number_format($value, $decimalPlaces, '.', '');
				$value = $value*1.0;
			}
		}
		
		return $value;
	}
	
	/**
	 * Método responsável por converter uma quantidade de segundos em um formato
	 * mais elegante de apresentação em forma de horas, minutos e segundos 
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Quantidade total de segundos
	 * @param      String: Formato desejado de saída
	 * @return     String
	 */
	public static function formatTimeString( $seconds, $format=null ){
		
		$seconds = ($seconds?$seconds:0);
		
		$days = ceil($seconds/86400);
		$hours = ceil($seconds/86400);
		
		$days = floor($seconds/86400);
		$seconds = $seconds - ($days*86400);
	
		$hours = floor($seconds/3600);
		$seconds = $seconds - ($hours*3600);
	
		$minutes = floor($seconds/60);
		$seconds = floor($seconds - ($minutes*60));
		
		$days    = sprintf('%02d', $days);
		$hours   = sprintf('%02d', $hours);
		$minutes = sprintf('%02d', $minutes);
		$seconds = sprintf('%02d', $seconds);
		
		$timeString = array();
		$timeString['days']    = $days;
		$timeString['d']       = $days;
		$timeString['hours']   = $hours;
		$timeString['h']       = $hours;
		$timeString['minutes'] = $minutes;
		$timeString['m']       = $minutes;
		$timeString['seconds'] = $seconds;
		$timeString['s']       = $seconds;
		
		if( $format ){
			switch( $format ){
				case '%h:%m:%s':
					return sprintf('%02d', ($hours+($days*24))).':'.$minutes.':'.$seconds;
				case '%hh %mm %ss':
					return sprintf('%02d', ($hours+($days*24))).'h '.$minutes.'m '.$seconds.'s';
				case '%h:%m':
					return sprintf('%02d', ($hours+($days*24))).':'.$minutes;
			}
				
			return $timeString[$format];
		}

		return sprintf('%02d', ($hours+($days*24))).'h '.$minutes.'m '.$seconds.'s';
	}
	
	/**
	 * Método responsável por organizar e retornar uma lista de e-mails
	 * de acordo com os dados passados como parâmetro 
	 *
	 * @author     Luciano Stegun
	 * @param      String: E-mails em forma de lista separada por vírgula ou ponto e vírgula
	 * @return     Array
	 */
	public static function getEmailArray( $emailAddressList ){

		$emailAddressReturnList = array();
		
	  	if( is_array($emailAddressList) ){
	  		
	  		if( count($emailAddressList)==0 )
	  			return $emailAddressList;
	  			
	  		foreach( $emailAddressList as $emailAddressItemList )
	  			$emailAddressReturnList = array_merge($emailAddressReturnList, Util::getEmailArray($emailAddressItemList));
	  		
	  	}else{
	  		$emailAddressReturnList[] = $emailAddressList;
	  	}

		$emailAddressList = implode(',', $emailAddressReturnList);
		$emailAddressList = str_replace(';', ',', $emailAddressList);
	  	$emailAddressList = str_replace(' ', '', $emailAddressList);
	  	$emailAddressList = str_replace('%2540', '@', $emailAddressList);
	  	$emailAddressList = explode(',', $emailAddressList);
	  	
	  	return $emailAddressReturnList;
	}

	/**
	 * Método que envia ao cabeçalho do browser informações de que o retorno gerado
	 * pela requisição é um arquivo XLS 
	 *
	 * @author     Luciano Stegun
	 * @param      String: Nome do arquivo que será gerado para download
	 */
	public static function headerExcel( $fileName ){
		
	    header('Content-type: application/vnd.ms-excel');
		header('Content-type: application/force-download');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		header('Pragma: no-cache');
	}

	/**
	 * Método que envia ao cabeçalho do browser informações que forçam
	 * o download dos dados carregados
	 *
	 * @author     Luciano Stegun
	 * @param      String: Nome do arquivo que será gerado para download
	 */
	public static function forceDownload( $fileName, $mimeType=null ){
		
		header('Content-type: application/force-download');
		
		if( $mimeType )
			header('Content-type: '.$mimeType);
			
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Pragma: no-cache');
	}
	
	/**
	 * Método que retorna o código do browser utilizado para acesso ao sistema
	 *
	 * @author     Luciano Stegun
	 * @param      String: Código para comparação, retornando true ou false se for igual ao browser utilizado
	 */   
	public static function getBrowser($browserMatch=null){
	
		$browser = (strstr( $_SERVER['HTTP_USER_AGENT'], 'compatible; MSIE')?'IE':'other');
		if( $browserMatch )
			return ($browserMatch==$browser);
			
		return $browser;
	}
	
	public static function getDate($dateIncrase){
		
		$dateIncrase = strtolower($dateIncrase);
		$dateIncrase = preg_replace('/[^-0-9dwmy]/', '', $dateIncrase);
		$daysIncrase = 0;
		
		if( preg_match('/^-?[0-9]*d$/', $dateIncrase) )
			$daysIncrase = str_replace('d', '', $dateIncrase);
		elseif( preg_match('/^-?[0-9]*w$/', $dateIncrase) )
			$daysIncrase = str_replace('w', '', $dateIncrase)*7;
		elseif( preg_match('/^-?[0-9]*m$/', $dateIncrase) )
			$daysIncrase = str_replace('m', '', $dateIncrase)*30;
		elseif( preg_match('/^-?[0-9]*y$/', $dateIncrase) )
			$daysIncrase = str_replace('y', '', $dateIncrase)*35;
		else
			throw new Exception('Parâmetro "'.$dateIncrase.'" inválido para o método Util::getDate()');
		
		return date('Y-m-d', mktime(0,0,0,date('m'),date('d')+$daysIncrase,date('Y')));
	}
	
	/**
	 * Método que retorna a data por extenso
	 *
	 * @author     Luciano Stegun
	 * @param      String: Data a ser convertida
	 * @param      Boolean: Define se o retorno será em português
	 */
	public static function getDateString( $date, $portuguese=true ){
		
		if( !$portuguese )
			return self::getDateStringEnglish($date);
			
		$date = Util::formatDate($date, 'database', 'Y-m-d');
		list($year, $month, $day) = explode('-', $date);
		$weekDay = date('w', strtotime($date));
		
		$monthList[1] = 'janeiro';
		$monthList[2] = 'fevereiro';
		$monthList[3] = 'março';
		$monthList[4] = 'abril';
		$monthList[5] = 'maio';
		$monthList[6] = 'junho';
		$monthList[7] = 'julho';
		$monthList[8] = 'agosto';
		$monthList[9] = 'setembro';
		$monthList[10] = 'outubro';
		$monthList[11] = 'novembro';
		$monthList[12] = 'dezembro';
		
		$weekDayList[] = 'domingo';
		$weekDayList[] = 'segunda-feira';
		$weekDayList[] = 'terça-feira';
		$weekDayList[] = 'quarta-feira';
		$weekDayList[] = 'quinta-feira';
		$weekDayList[] = 'sexta-feira';
		$weekDayList[] = 'sábado';
		
		return ($weekDayList[$weekDay].', '.$day.' de '.$monthList[$month].' de '.$year);
	}
	
	/**
	 * Método que retorna a data por extenso em inglês
	 *
	 * @author     Luciano Stegun
	 * @param      String: Data a ser convertida
	 */
	public static function getDateStringEnglish( $date ){
		
		$date = Util::formatDate($date, 'database', 'Y-m-d');
		list($year, $month, $day) = explode('-', $date);
		$weekDay = date('w', strtotime($date));
		
		$monthList[1] = 'january';
		$monthList[2] = 'february';
		$monthList[3] = 'march';
		$monthList[4] = 'april';
		$monthList[5] = 'may';
		$monthList[6] = 'june';
		$monthList[7] = 'july';
		$monthList[8] = 'august';
		$monthList[9] = 'september';
		$monthList[10] = 'october';
		$monthList[11] = 'november';
		$monthList[12] = 'december';
		
		$weekDayList[] = 'sunday';
		$weekDayList[] = 'monday';
		$weekDayList[] = 'tuesday';
		$weekDayList[] = 'wednesday';
		$weekDayList[] = 'thursday';
		$weekDayList[] = 'friday';
		$weekDayList[] = 'saturday';
		
		return ($weekDayList[$weekDay].', '.$year.' '.$monthList[$month].' '.$day);
	}
	
	/**
	 * Método que retorna o nome do mês por extenso
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Número do mês
	 * @return     String
	 */
	public static function getMonthName($month, $short=false){
		
		$monthList = self::getMonthNames();
		
		if( $short )
			return substr($monthList[$month*1], 0, 3);
		else
			return $monthList[$month*1];
	}

	public static function getMonthNames($lowercase=false){
		
		$monthList     = array();
		$monthList[1]  = 'Janeiro';
		$monthList[2]  = 'Fevereiro';
		$monthList[3]  = 'Março';
		$monthList[4]  = 'Abril';
		$monthList[5]  = 'Maio';
		$monthList[6]  = 'Junho';
		$monthList[7]  = 'Julho';
		$monthList[8]  = 'Agosto';
		$monthList[9]  = 'Setembro';
		$monthList[10] = 'Outubro';
		$monthList[11] = 'Novembro';
		$monthList[12] = 'Dezembro';
		
		if( $lowercase )
			foreach($monthList as &$month)
				$month = strtolower($month);
		
		return $monthList;
	}
	
	/**
	 * Método que retorna a quantidade de dias do mês/ano passados
	 * como parâmetro
	 *
	 * @author     Luciano Stegun
	 * @param      Integer: Número do mês
	 * @param      Integer: Número do ano
	 * @return     String
	 */
	public static function getMonthDays($month, $year){
		
		$month *= 1;
		
		if( $month==0 ){
			
			$month = 12;
			$year--;
		}
		
		$monthDays     = array();
		$monthDays[1]  = 31;
		$monthDays[2]  = ($year%4==0?29:28);
		$monthDays[3]  = 31;
		$monthDays[4]  = 30;
		$monthDays[5]  = 31;
		$monthDays[6]  = 30;
		$monthDays[7]  = 31;
		$monthDays[8]  = 31;
		$monthDays[9]  = 30;
		$monthDays[10] = 31;
		$monthDays[11] = 30;
		$monthDays[12] = 31;
		
		return $monthDays[$month];
	}
	
	public static function getSeconds($dateTime){
		
		if( ereg('^[0-9]{1,2}:[0-9]{1,2}$', $dateTime) ){
			
			list($hours, $minutes) = explode(':', $dateTime);
			
			$seconds = $hours*60*60+$minutes*60;
		}
		
		return $seconds;
	}
	
	public static function getHelpers(){
		
		require_once ('symfony/helper/HelperHelper.php');
		use_helper('Object');
		use_helper('Asset');
		use_helper('Tag');
		use_helper('Url');
	}
	
	public static function getHelper($helper){
		
		sfLoader::loadHelpers($helper);
	}
	
	/**
	 * Método que retorna o nome do arquivo baseado em seu endereço
	 * 
	 * @author		Luciano Stegun
	 */
	public static function getFileName( $filePath ){
		
		$filePath = split('[\\\\/]', $filePath);
		return end($filePath);
	}
	
	/**
	 * Método que retorna o endereço no servidor a partir da pasta web
	 * 
	 * @author		Luciano Stegun
	 */
	public static function getFilePath($subPath, $rootDir=null){
		
		$subPath = ereg_replace('[\\\\/]', DIRECTORY_SEPARATOR, $subPath);
		$subPath = ereg_replace('^[\\\\/]?', '', $subPath);
		
		if( !$rootDir )
			$rootDir = sfConfig::get('sf_web_dir');
		
		$path = $rootDir . DIRECTORY_SEPARATOR . $subPath;
		return $path;
	}
	
	/**
	 * Método que processa um array e converte em um objeto javascript
	 * 
	 * @author		Luciano Stegun
	 */
	 public static function parseInfo($infoList){
	 	
	 	return json_encode($infoList);
	 }
	
	/**
	 * Método que inclui um indicador visual de informação de processamento
	 * em progresso, utilizado no layout principal 
	 *
	 * @author     Luciano Stegun
	 */
	public static function getLoading(){
		
		echo get_partial( 'home/include/loading' );
	}
	 
	 public static function convertTimeToSeconds( $time ){
	 	
	 	if( !ereg('^[0-9]{1,2}:[0-9]{1,2}(:[0-9]{1,2})?$', $time) )
	 		return 0;
	 		
	 	list($hours, $minutes, $seconds) = explode(':', $time);
	 	
	 	$hours   *= 3600;
	 	$minutes *= 60;
	 	
	 	return $seconds+$minutes+$hours;
	 }
	 
	 public static function getSvnRevision(){
	 	
	 	$path = realpath(dirname(__FILE__).'/../.svn');
	 	if( !$path )
	 		return '0000';
	 	
	 	$file     = file($path.'/entries');
	 	$revision = $file[3];
	 	return sprintf('%04d', $revision);
	 }
	 
	public static function getTimeAgo($timeAgo){

    	$minutes = 60;
    	$hours   = $minutes*60;
    	$days    = $hours*24;
    	$weeks   = $days*7;
    	$months  = $days*30;
    	$years   = $months*12;
    	
    	$timeAgo = time()-$timeAgo;
    	
    	self::getHelper('I18N');
    	
    	if( $timeAgo >= $years ){
    		
    		$timeAgo = ceil($timeAgo/$years);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('year'):__('years'));
    	}elseif( $timeAgo >= $months ){
    		
    		$timeAgo = ceil($timeAgo/$months);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('month'):__('months'));
    	}elseif( $timeAgo >= $weeks ){
    		
    		$timeAgo = ceil($timeAgo/$weeks);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('week'):__('weeks'));
    	}elseif( $timeAgo >= $days ){
    		
    		$timeAgo = ceil($timeAgo/$days);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('day'):__('days'));
    	}elseif( $timeAgo >= $hours ){
    		
    		$timeAgo = ceil($timeAgo/$hours);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('hour'):__('hours'));
    	}elseif( $timeAgo >= $minutes ){
    		
    		$timeAgo = ceil($timeAgo/$minutes);
    		$timeAgo = $timeAgo.' '.($timeAgo==1?__('minute'):__('minutes'));
    	}else{
    		
    		$timeAgo = __('less1Minute');
    	}
    	
    	return $timeAgo;
	}
	
	public static function getOrdinalSufix($place){
		
		$culture = MyTools::getCulture();
		
		if( $culture=='pt_BR' )
			return 'º';
		
		if( $culture=='en_US' ){
			if( ereg('1$', $place) ) $sufix = 'st';
			elseif( ereg('2$', $place) ) $sufix = 'nd';
			elseif( ereg('3$', $place) ) $sufix = 'rd';
			else $sufix = 'th';
			
			return $sufix;
		}
	}
	
	public static function implode_with_key($assoc, $inglue='>', $outglue=',', $lastChar='') {
		
	    $return = '';
	 
	    foreach ($assoc as $tk => $tv) {
	        $return .= $outglue . $tk . $inglue . $tv;
	    }
	 
	    return substr($return, strlen($outglue)).$lastChar;
	}
	
	// Métodos utilizados no backend
	public static function getFormStatus($successMessage=null, $errorMessage=null){
		
		echo get_partial('home/include/formStatus', array('successMessage'=>$successMessage, 'errorMessage'=>$errorMessage, 'statusId'=>null, 'window'=>false));
	}
	
	public static function getApp(){
		
		$scriptName = MyTools::getRequest()->getScriptName();
		$scriptName = ereg_replace('[^a-zA-Z]', '', $scriptName);
		$scriptName = ereg_replace('(dev)?php$', '', $scriptName);
		
		$scriptName = ($scriptName=='index'?'frontend':$scriptName);
		return $scriptName;
	}
	
	public static function isApp($app){
		
		return (self::getApp()==$app);
	}
	
	public static function buildXml($nodeList, $root, $mainNode){
		
		$nl = chr(10);
		header('content-type: text/xml; charset=UTF-8');

		$xmlString  = '<?xml version="1.0" encoding="UTF-8"?>'.$nl;
		$xmlString .= '<'.$root.'>'.$nl;
		foreach($nodeList as $nodeNode){
			
			$xmlString .= self::getXmlNode($nodeNode, $mainNode);
		}
		
		$xmlString .= '</'.$root.'>'.$nl;
		
		return $xmlString;
	}
	
	public static function getXmlNode($nodeList, $mainNode, $identLevel=1){
		
		$xmlString = '';
		$nl = chr(10);
		$tb = str_repeat('	', $identLevel);
		
		$attributeString = '';
		
		if( array_key_exists('@attributes', $nodeList) ){
			foreach($nodeList['@attributes'] as $nodeName=>$nodeValue)
				$attributeString .= ' '.$nodeName.'="'.$nodeValue.'"';
			unset($nodeList['@attributes']);
		}
		
		$xmlString .= $tb.'<'.$mainNode.$attributeString.'>'.$nl;	
		foreach($nodeList as $nodeName=>$nodeValue){
			
			if( is_array($nodeValue) ){
				
				$xmlString .= self::getXmlNode($nodeValue, $nodeName, $identLevel+1);
				continue;
			}
			
			$xmlString .= $tb.'	<'.$nodeName.'>';
			$xmlString .= htmlspecialchars($nodeValue);
			$xmlString .= '</'.$nodeName.'>'.$nl;
		}
		
		$xmlString .= $tb.'	</'.$mainNode.'>'.$nl;
		
		return $xmlString;
	}
	
	public static function getConvertCulture($language){
		
		$language = strtolower($language);
		
		switch($language){
			case 'en':
				return 'en_US';
			case 'pt':
			default:
				return 'pt_BR';
		}
	}
	
	public static function getWeekDay($date){
	
		$date = Util::formatDate($date);
		$weekDay = date('w', strtotime($date));
	
		$weekDayList   = array();
		$weekDayList[] = 'Domingo';
		$weekDayList[] = 'Segunda-feira';
		$weekDayList[] = 'Terça-feira';
		$weekDayList[] = 'Quarta-feira';
		$weekDayList[] = 'Quinta-feira';
		$weekDayList[] = 'Sexta-feira';
		$weekDayList[] = 'Sábado';
		
		return $weekDayList[$weekDay];
	}
	
	public static function getDirectUrlId($pattern){
		
		$pattern = str_replace('/', '\\/', $pattern);
		
		$pathInfo = $_SERVER['PATH_INFO'];
  		$objectId = preg_replace('/^\/'.$pattern.'\//', '', $pathInfo);
  		$objectId = preg_replace('/\/.*$/', '', $objectId);
  		$objectId = base64_decode($objectId);
  		
  		if( !is_numeric($objectId) )
  			$objectId = null;
  		
  		return $objectId;
	}
	
	public static function getOptionsForJquerySelect($optionList){
		
		$returnOptionList = array();
		foreach($optionList as $optionValue=>$optionDisplay)
			$returnOptionList[] = array('optionValue'=>$optionValue, 'optionDisplay'=>$optionDisplay);
		
		return $returnOptionList;
	}
	
	public static function encodeId($id){
		
		return strrev(base64_encode($id));
	}
	
	public static function decodeId($id){
		
		return base64_decode(strrev($id));
	}
	
	public static function differenceDays($date1, $date2){
		
//		$date1 = "2007-03-24";
//		$date2 = "2009-06-26";
		
		$diff = abs(strtotime($date2) - strtotime($date1));
		
		$years  = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		
		return $days;
	}
	
	public static function lightbox(){

		sfContext::getInstance()->getResponse()->addStylesheet('lightbox');
		sfContext::getInstance()->getResponse()->addJavascript('/sf/prototype/js/scriptaculous');
		sfContext::getInstance()->getResponse()->addJavascript('lightbox');
	}
}
?>