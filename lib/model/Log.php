<?php

/**
 * Subclasse de representação de objetos da tabela 'log'.
 *
 * 
 *
 * @package lib.model
 */ 
class Log extends BaseLog
{
	
    const LOG_EMERGENCY     = 4;     # System is unusable
    const LOG_CRITICAL      = 3;     # Critical conditions
    const LOG_ERROR         = 2;     # Error conditions
    const LOG_WARN          = 1;     # Warning conditions
    const LOG_INFORMATION   = 0;     # Informational
	
    public function getCode(){
    	
    	return '#'.sprintf('%05d', $this->getId());
    }
    
    public static function doLog($message, $className=null, $columnModifiedList=array(), $severity=self::LOG_INFORMATION){

    	$userSiteId  = sfContext::getInstance()->getUser()->getAttribute('userSiteId');
    	$userAdminId = sfContext::getInstance()->getUser()->getAttribute('userAdminId');
    	
    	$app = Util::getApp();
        
        $moduleName = sfContext::getInstance()->getModuleName();
        $actionName = sfContext::getInstance()->getActionName();
        
        if( $moduleName=='Home' && $actionName=='getNewId' )
        	return true;
        
        $message = str_replace('\\', '/', $message);
        
        $logObj = new Log;
        $logObj->setUserSiteId(nvl($userSiteId)); // Logs sem usuários são logs do sistema
        $logObj->setUserAdminId(nvl($userAdminId)); // Logs sem usuários são logs do sistema
        $logObj->setApp( $app );
        $logObj->setModuleName( $moduleName );
        $logObj->setActionName( $actionName );
        $logObj->setClassName( $className );
        $logObj->setMessage( $message );
        $logObj->setSeverity( $severity );
        $logObj->save();
        
        if( $severity >= self::LOG_ERROR )
        	Report::sendMail('iRank Log', 'lucianostegun@gmail.com', $logObj->toString(), array('emailTemplate'=>'emailTemplateAdmin'));
        
        $logId = $logObj->getId();
        
        if( count($columnModifiedList) ){
			
			$sql     = 'INSERT INTO log_field VALUES';
			$sqlList = array();
			foreach($columnModifiedList as $fieldName=>$fieldValue){
			
				$fieldValue = substr($fieldValue,0,255);
				$sqlList[]  = "($logId, '$fieldName', '".addslashes($fieldValue)."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";	    	
			}
			
		    $sql .= chr(10).chr(9).implode(','.chr(10).chr(9), $sqlList);
		    Util::executeQuery($sql, 'log');
        }
        
        return $logId;
    }
    
    public static function quickLog($tableName, $primaryKey, $isNew, $columnModifiedList, $className=null){
	
    	if( !$columnModifiedList )
    		return false;
    		
    	if( is_array($primaryKey) )    		
    		$primaryKey = implode(' e ', $primaryKey);
    	
    	if( $isNew )
	       	self::doLog('Inseriu o registro '.$primaryKey.' na tabela '.$tableName, $className, $columnModifiedList);
	    else
	    	self::doLog('Editou o registro '.$primaryKey.' na tabela '.$tableName, $className, $columnModifiedList);
    }
    
    public static function quickLogError($tableName, $primaryKey, $e){
    	
    	if( is_array($primaryKey) )    		
    		$primaryKey = implode(' e ', $primaryKey);
    	
    	throw new LogException('Erro ao salvar o registro '.$primaryKey.' na tabela '.$tableName.'. [' . $e->getMessage() . ']');
    }
    
    public static function quickLogDelete($tableName, $primaryKey){
    	
    	if( is_array($primaryKey) )    		
    		$primaryKey = implode(' e ', $primaryKey);
    	
    	self::doLog('Excluiu o registro '.$primaryKey.' na tabela '.$tableName);
    }
    
    public function getMessage( $handle=false ){

		$message = parent::getMessage();
		
		if( $handle=='list' ){
			
			$message = ereg_replace('. Colunas \[.*$', '', $message);
		}
		
		if( $handle=='edit' ){
			
			Util::getHelpers();
			
			$lineMessage = ereg_replace(' Colunas \[.*$', '', $message);
			$message = ereg_replace('^.*Colunas \[', '', $message);
			$message = ereg_replace(']$', '', $message);
			
			$messageList   = explode(chr(9), $message);
			$className     = $this->getClassName();
			$classNamePeer = 'Base'.$className.'Peer';
			
			$html = $lineMessage;
			
				
			$fieldAliasList = array();
			if( $className )
				eval('$fieldAliasList = '.$classNamePeer.'::getFieldNames(BasePeer::TYPE_ALIAS);');				

			$html .= '<br/><br/><table>';

			foreach( $messageList as $message){
				
				$columnName         = ereg_replace('\: .*', '', $message);
				$originalColumnName = $columnName;
				$columnName         = strtoupper($columnName);
				$columnValue        = ereg_replace('^[A-Z_]*: ', '', $message);
				$columnValue        = trim($columnValue);
				
				$columnDescription = (isset($fieldAliasList[$columnName])?$fieldAliasList[$columnName]:'');
				if( !$columnDescription )
					if( !$className ){
						$columnName        = $originalColumnName;
						$columnDescription = $columnName;
					}else{
						
						$columnDescription = $columnName;
						$columnValue       = str_replace($originalColumnName.':', '', $columnValue);
						$columnValue       = trim($columnValue);
					}
				
				if( ereg('^[A-Z]+[A-Z_]*_ID_?', $columnName) ){
					
					$className = ereg_replace('_ID[A-Z_]*$', '', $columnName);
					$className = str_replace('_', ' ', $className);
					$className = strtolower($className);
					$className = ucwords($className);
					$className = str_replace(' ', '', $className);
					$classPeer = $className.'Peer';
					
					$className = strtolower(substr($className, 0, 1)).substr($className, 1, strlen($className));
					
					if( !class_exists($classPeer) )
						$classPeer = 'VirtualTablePeer';
					
					$object = null;
					eval('$object = '.$classPeer.'::retrieveByPK( '.$columnValue.' );');
					
					if( is_object($object)){
						
						$toString    = $object->toString();
//								$columnValue = $toString.' ('.link_to($columnValue, $className.'/view?id='.$columnValue, array('target'=>'_blank')).')';
						$columnValue = $toString.' ('.$columnValue.')';
					}
				}
				
				$html .= '<tr>';
				$html .= '<th align="right">'.$columnDescription.':</th>';
				$html .= '<td style="padding-left: 5px">'.$columnValue.'</td>';
				$html .= '</tr>';
			}
			$html .= '</table>';
				
			$message = $html;
		}
		$message = str_replace( 'Colunas []', '<BR /><BR /><b><i>Nenhuma coluna foi alterada</i></b>', $message );
		
		return $message;
    }
    
    public static function getModifiedColumnList( $class ){
    	
		$modifiedColumnList = array();
    	$fieldNameList      = array();
    	$phpNameList        = array();
    	
		$className = 'Base'.get_class($class).'Peer';
		eval('$fieldNameList = '.$className.'::getFieldNames(BasePeer::TYPE_COLNAME);');
		eval('$phpNameList   = '.$className.'::getFieldNames(BasePeer::TYPE_PHPNAME);');
		
		foreach( $fieldNameList as $key=>$fieldName ){
			
			$getFunction = 'get'.$phpNameList[$key];
			
			if( $class->$getFunction()==='' && $class->$getFunction()!==NULL && $class->$getFunction()!==false )
				$class->resetModified($fieldName);
				
			if ($class->isColumnModified( $fieldName )){
				
				$value = $class->$getFunction();
				
				if( is_bool($value) )
					$value = ($value?'Sim':'Não');

//				if( $getFunction!='getId' && strstr($getFunction, 'Id')){
//
//					$getToString = str_replace('Id', '', $getFunction);
//					$object      = $class->$getToString();
//					
//					if( is_object($object) )
//						$value = '('.$value.') '.$object->toString();
//					 
//				}
				
				$fieldName                      = ereg_replace('^[a-zA-Z_]*\.', '', $fieldName);
				$fieldDescription               = $fieldName;
				$modifiedColumnList[$fieldName] = $value;
			}
		}

		return $modifiedColumnList;
    }
    
    public function getModule(){
    	
    	$criteria = new Criteria();
    	$criteria->add( ModulePeer::EXECUTE_MODULE, $this->getModuleName() );
    	$moduleObj = ModulePeer::doSelectOne( $criteria );
    	
    	if( !is_object($moduleObj) )
    		$moduleObj = new Module();
    	
    	return $moduleObj;
    }
    
    public function getUserSite($con=null){
    	
    	$userSiteObj = parent::getUserSite($con);
    	
    	if( !is_object($userSiteObj) )
    		$userSiteObj = new UserSite();
    	
    	return $userSiteObj;
    }
    
    public function toString(){
    	
    	$nl = '<br/>';
    	
		$string = '<div style="line-height: 180%">'.$nl;
		$string .= '<b>Data/Hora: </b>'.$this->getCreatedAt('d/m/Y H:i:s').$nl;
		$string .= '<b>Modulo: </b>'.$this->getModuleName().$nl;
		$string .= '<b>Pagina: </b>'.$this->getActionName().$nl;
		$string .= '<b>IP: </b>'.$_SERVER['REMOTE_ADDR'].$nl;
		$string .= '<b>URI: </b>'.$_SERVER['REQUEST_URI'].$nl;
		$string .= '<b>Mensagem: </b><br/><div style="padding: 25px 10px; margin: 10px 0px; border-top: 1px solid #909090; border-bottom: 1px solid #909090">'.$this->getMessage().'</div><b>iRank Admin</b>';
		$string .= '</div>';
    	
    	return $string;
    }
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']          = $this->getId();
		$infoList['code']        = $this->getCode();
		$infoList['userSiteId']  = $this->getUserSiteId();
		$infoList['app']         = $this->getApp();
		$infoList['moduleName']  = $this->getModuleName();
		$infoList['module']      = $this->getModule()->getToolbarDescription();
		$infoList['actionName']  = $this->getActionName();
		$infoList['className']   = $this->getClassName();
		$infoList['message']     = $this->getMessage('edit');
		$infoList['createdAt']   = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']   = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
