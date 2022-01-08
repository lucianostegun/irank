<?php

class HttpsFilter extends sfFilter {
    
    public function execute($filterChain) {

//		if( !$this->isFirstCall() )
//			return $filterChain->execute();
        
		$actionName = MyTools::getRequest()->getParameterHolder()->get('action');
		$moduleName = MyTools::getRequest()->getParameterHolder()->get('module');
		$serverName = $_SERVER['SERVER_NAME'];
		
		if( !preg_match('/irank\.com\.br/', $serverName) )
			return $filterChain->execute();
		
		if( $moduleName=='store' && (!isset($_SERVER['HTTPS']) || isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='on') ){
  		
	  		$redirectUrl = null;
	  		
	  		if( isset($_SERVER['REDIRECT_SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['REDIRECT_SCRIPT_URI'];
	  		
	  		elseif( isset($_SERVER['SCRIPT_URI']) )
	  			$redirectUrl = $_SERVER['SCRIPT_URI'];
	  		
	  		if( $redirectUrl ){
	  			
	  			$redirectUrl = str_replace('http://', 'https://', $redirectUrl);
				sfContext::getInstance()->getController()->redirect($redirectUrl);
	  		}
	  	}
//	  	elseif( $moduleName!='store' && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ){
//
//	  		$redirectUrl = null;
//	  		
//	  		if( isset($_SERVER['REDIRECT_SCRIPT_URI']) )
//	  			$redirectUrl = $_SERVER['REDIRECT_SCRIPT_URI'];
//	  		
//	  		elseif( isset($_SERVER['SCRIPT_URI']) )
//	  			$redirectUrl = $_SERVER['SCRIPT_URI'];
//	  		
//	  		if( isset($_SERVER['REDIRECT_QUERY_STRING']) )
//	  			$redirectUrl .= '?'.$_SERVER['REDIRECT_QUERY_STRING'];
//	  		
//	  		if( $redirectUrl ){
//	  			
//	  			$redirectUrl = str_replace('https://', 'http://', $redirectUrl);
//		  		sfContext::getInstance()->getController()->redirect($redirectUrl);
//	  		}
//	  	}
	  	
        $filterChain->execute();
    }
}
?>